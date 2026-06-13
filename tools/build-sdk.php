<?php

/**
 * Reproducible SDK builder for php-wethod-sdk. Run with: composer generate
 *
 * Pipeline:
 *   1. Run crescat-io/saloon-sdk-generator on resources/openapi.yaml to scaffold
 *      DTO classes (we only keep these for their property lists).
 *   2. Convert those spatie/laravel-data DTOs into plain readonly PHP DTOs.
 *   3. Regenerate clean Saloon Request/Resource/Connector classes directly from
 *      the spec (correct auth/headers, action endpoints, request bodies, DTO
 *      mapping and pagination markers).
 *
 * NOTE: this overwrites src/Dto, src/Requests, src/Resource and src/Wethod.php.
 * The hand-written Connector cross-cutting code lives in the template below.
 */

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

$root = dirname(__DIR__);
require $root.'/vendor/autoload.php';

const NS = 'EnricoDeLazzari\\Wethod';

// 1. scaffold raw DTOs with the generator, then refresh src/Dto from them.
$rawDir = "$root/build/sdk-raw";
$generator = escapeshellarg("$root/vendor/bin/sdkgenerator");
exec('rm -rf '.escapeshellarg($rawDir));
exec(
    "$generator generate:sdk ".escapeshellarg("$root/resources/openapi.yaml").
    " --type=openapi --name=Wethod --namespace='EnricoDeLazzari\\Wethod' --output=".
    escapeshellarg($rawDir).' --force 2>&1',
    $genOut,
    $genRc,
);
if ($genRc !== 0 || ! is_dir("$rawDir/Dto")) {
    fwrite(STDERR, "saloon-sdk-generator failed:\n".implode("\n", $genOut)."\n");
    exit(1);
}
exec('rm -rf '.escapeshellarg("$root/src/Dto"));
exec('cp -R '.escapeshellarg("$rawDir/Dto").' '.escapeshellarg("$root/src/Dto"));

$spec = Yaml::parseFile($root.'/resources/openapi.yaml');

/* ----------------------------- helpers ------------------------------ */

function camel(string $s): string
{
    $s = str_replace([' ', '-'], '_', $s);
    $parts = explode('_', $s);
    $first = array_shift($parts);

    return lcfirst($first).implode('', array_map('ucfirst', $parts));
}

function pascal(string $s): string
{
    return ucfirst(camel($s));
}

function phpType(?array $schema): string
{
    return match ($schema['type'] ?? 'string') {
        'integer' => 'int',
        'number' => 'float',
        'boolean' => 'bool',
        'array' => 'array',
        default => 'string',
    };
}

function refName(?array $schema): ?string
{
    if (! $schema) {
        return null;
    }
    if (isset($schema['$ref'])) {
        return basename($schema['$ref']);
    }

    return null;
}

/** Returns [dtoName, isList] for the success response, or [null, false]. */
function successDto(array $operation): array
{
    foreach (['200', '201', 200, 201] as $code) {
        $schema = $operation['responses'][$code]['content']['application/json']['schema'] ?? null;
        if (! $schema) {
            continue;
        }
        if (($schema['type'] ?? null) === 'array') {
            $name = refName($schema['items'] ?? null);

            return $name ? [$name, true] : [null, false];
        }
        $name = refName($schema);
        if ($name) {
            return [$name, false];
        }
    }

    return [null, false];
}

/* --------------------------- parse spec ----------------------------- */

$operations = []; // tag => list of op meta
foreach ($spec['paths'] as $path => $methods) {
    foreach ($methods as $httpMethod => $op) {
        if (! is_array($op) || ! isset($op['operationId'])) {
            continue;
        }
        $tag = $op['tags'][0] ?? 'Default';
        $pathParams = [];
        $queryParams = [];
        foreach ($op['parameters'] ?? [] as $param) {
            if (isset($param['$ref'])) {
                continue; // CompanyHeader / ApiVersionHeader -> handled by connector
            }
            if (($param['in'] ?? null) === 'path') {
                $pathParams[] = ['name' => $param['name'], 'type' => phpType($param['schema'] ?? null)];
            } elseif (($param['in'] ?? null) === 'query') {
                $queryParams[] = ['name' => $param['name'], 'type' => phpType($param['schema'] ?? null)];
            }
        }
        [$dto, $isList] = successDto($op);
        $operations[$tag][] = [
            'id' => $op['operationId'],
            'method' => strtoupper($httpMethod),
            'path' => $path,
            'summary' => trim(explode("\n", $op['summary'] ?? $op['operationId'])[0]),
            'pathParams' => $pathParams,
            'queryParams' => $queryParams,
            'hasBody' => isset($op['requestBody']),
            'dto' => $dto,
            'isList' => $isList,
        ];
    }
}

/* ------------------------ emit request classes ---------------------- */

function endpointExpr(string $path): string
{
    // Replace {paramName} with {$this->camelName}; keep literal :action suffix.
    return preg_replace_callback('/\{([a-zA-Z0-9_]+)\}/', static fn ($m) => '{$this->'.camel($m[1]).'}', $path);
}

$requestsDir = "$GLOBALS[root]/src/Requests";
$resourceDir = "$GLOBALS[root]/src/Resource";
$dtoNs = NS.'\\Dto';

// wipe & recreate request + resource dirs
exec('rm -rf '.escapeshellarg($requestsDir).' '.escapeshellarg($resourceDir));

$requestCount = 0;
foreach ($operations as $tag => $ops) {
    $tagClass = pascal($tag);
    $tagDir = "$requestsDir/$tagClass";
    @mkdir($tagDir, 0775, true);

    foreach ($ops as $op) {
        $class = pascal($op['id']);
        $uses = [
            'Saloon\\Enums\\Method',
            'Saloon\\Http\\Request',
        ];
        $interfaces = [];
        $bodyTrait = '';
        $bodyMethod = '';
        if ($op['hasBody']) {
            $uses[] = 'Saloon\\Contracts\\Body\\HasBody';
            $uses[] = 'Saloon\\Traits\\Body\\HasJsonBody';
            $interfaces[] = 'HasBody';
            $bodyTrait = "\n    use HasJsonBody;\n";
            $bodyMethod = <<<'PHP'


                public function defaultBody(): array
                {
                    return $this->data;
                }
            PHP;
        }
        if ($op['isList']) {
            $uses[] = 'Saloon\\PaginationPlugin\\Contracts\\Paginatable';
            $interfaces[] = 'Paginatable';
        }
        $implements = $interfaces ? ' implements '.implode(', ', $interfaces) : '';

        // constructor params: path (required) -> query (optional) -> data (optional)
        $params = [];
        foreach ($op['pathParams'] as $p) {
            $params[] = "        protected {$p['type']} \$".camel($p['name']).',';
        }
        foreach ($op['queryParams'] as $p) {
            $params[] = "        protected ?{$p['type']} \$".camel($p['name']).' = null,';
        }
        if ($op['hasBody']) {
            $params[] = '        /** @var array<string, mixed> */';
            $params[] = '        protected array $data = [],';
        }
        $ctor = $params
            ? "\n    public function __construct(\n".implode("\n", $params)."\n    ) {\n    }\n"
            : '';

        // defaultQuery
        $queryMethod = '';
        if ($op['queryParams']) {
            $pairs = [];
            foreach ($op['queryParams'] as $p) {
                $pairs[] = "'{$p['name']}' => \$this->".camel($p['name']);
            }
            $queryMethod = "\n\n    public function defaultQuery(): array\n    {\n        return array_filter([".implode(', ', $pairs)."]);\n    }";
        }

        // createDtoFromResponse
        $dtoMethod = '';
        if ($op['dto']) {
            $uses[] = 'Saloon\\Http\\Response';
            $uses[] = "$dtoNs\\{$op['dto']}";
            if ($op['isList']) {
                $dtoMethod = "\n\n    /**\n     * @return array<int, {$op['dto']}>\n     */\n    public function createDtoFromResponse(Response \$response): array\n    {\n        return {$op['dto']}::collect(\$response->json());\n    }";
            } else {
                $dtoMethod = "\n\n    public function createDtoFromResponse(Response \$response): {$op['dto']}\n    {\n        return {$op['dto']}::from(\$response->json());\n    }";
            }
        }

        $uses = array_values(array_unique($uses));
        sort($uses);
        $useBlock = implode("\n", array_map(static fn ($u) => "use $u;", $uses));

        $method = $op['method'];
        $endpoint = endpointExpr($op['path']);
        $summary = addslashes($op['summary']);

        $php = <<<PHP
        <?php

        namespace EnricoDeLazzari\\Wethod\\Requests\\$tagClass;

        $useBlock

        /**
         * $summary
         */
        class $class extends Request$implements
        {{$bodyTrait}
            protected Method \$method = Method::$method;

            public function resolveEndpoint(): string
            {
                return "$endpoint";
            }
        {$ctor}{$queryMethod}{$bodyMethod}{$dtoMethod}
        }

        PHP;

        file_put_contents("$tagDir/$class.php", $php);
        $requestCount++;
    }
}

/* ------------------------ emit resource classes --------------------- */

@mkdir($resourceDir, 0775, true);
$accessors = [];
foreach ($operations as $tag => $ops) {
    $tagClass = pascal($tag);
    $accessors[$tagClass] = lcfirst($tagClass);

    $uses = ['Saloon\\Http\\BaseResource'];
    $needResponse = false;
    $methods = [];

    foreach ($ops as $op) {
        $reqClass = pascal($op['id']);
        $uses[] = NS."\\Requests\\$tagClass\\$reqClass";

        $sigParams = [];
        $callArgs = [];
        foreach ($op['pathParams'] as $p) {
            $n = camel($p['name']);
            $sigParams[] = "{$p['type']} \$$n";
            $callArgs[] = "\$$n";
        }
        foreach ($op['queryParams'] as $p) {
            $n = camel($p['name']);
            $sigParams[] = "?{$p['type']} \$$n = null";
            $callArgs[] = "\$$n";
        }
        if ($op['hasBody']) {
            $sigParams[] = 'array $data = []';
            $callArgs[] = '$data';
        }

        $send = 'new '.$reqClass.'('.implode(', ', $callArgs).')';

        if ($op['dto']) {
            $uses[] = "$dtoNs\\{$op['dto']}";
            if ($op['isList']) {
                $ret = 'array';
                $doc = "\n    /**\n     * @return array<int, {$op['dto']}>\n     */";
                $body = "return \$this->connector->send($send)->dto();";
            } else {
                $ret = $op['dto'];
                $doc = '';
                $body = "return \$this->connector->send($send)->dto();";
            }
        } else {
            $needResponse = true;
            $ret = 'Response';
            $doc = '';
            $body = "return \$this->connector->send($send);";
        }

        $methods[] = "{$doc}\n    public function ".camel($op['id']).'('.implode(', ', $sigParams)."): $ret\n    {\n        $body\n    }";
    }

    if ($needResponse) {
        $uses[] = 'Saloon\\Http\\Response';
    }
    $uses = array_values(array_unique($uses));
    sort($uses);
    $useBlock = implode("\n", array_map(static fn ($u) => "use $u;", $uses));
    $methodsBlock = implode("\n\n", $methods);

    $php = <<<PHP
    <?php

    namespace EnricoDeLazzari\\Wethod\\Resource;

    $useBlock

    class $tagClass extends BaseResource
    {
    $methodsBlock
    }

    PHP;

    file_put_contents("$resourceDir/$tagClass.php", $php);
}

/* ----------------------------- emit connector ----------------------- */

ksort($accessors);
$connUses = [];
$connMethods = [];
foreach ($accessors as $class => $accessor) {
    $connUses[] = NS."\\Resource\\$class";
    $connMethods[] = "    public function $accessor(): $class\n    {\n        return new $class(\$this);\n    }";
}
sort($connUses);
$connUseBlock = implode("\n", array_map(static fn ($u) => "use $u;", $connUses));
$connMethodsBlock = implode("\n\n", $connMethods);

$connector = <<<PHP
<?php

namespace EnricoDeLazzari\\Wethod;

$connUseBlock
use EnricoDeLazzari\\Wethod\\Exceptions\\WethodRequestException;
use Saloon\\Http\\Connector;
use Saloon\\Http\\Auth\\TokenAuthenticator;
use Saloon\\Contracts\\Authenticator;
use Saloon\\Http\\Request;
use Saloon\\Http\\Response;
use Saloon\\PaginationPlugin\\Contracts\\HasPagination;
use Saloon\\PaginationPlugin\\Paginator;
use Saloon\\Traits\\Plugins\\AlwaysThrowOnErrors;

class Wethod extends Connector implements HasPagination
{
    use AlwaysThrowOnErrors;

    /**
     * @param  string  \$token        Personal API token (sent as a Bearer token).
     * @param  string  \$company      Company endpoint slug, e.g. "acme" for acme.wethod.com.
     * @param  string  \$apiVersion   Wethod API version.
     */
    public function __construct(
        protected string \$token,
        protected string \$company,
        protected string \$apiVersion = '2024-06-15',
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.wethod.com';
    }

    protected function defaultAuth(): Authenticator
    {
        return new TokenAuthenticator(\$this->token);
    }

    public function defaultHeaders(): array
    {
        return [
            'Wethod-Company' => \$this->company,
            'Wethod-Version' => \$this->apiVersion,
            'Accept' => 'application/json',
        ];
    }

    public function getRequestException(Response \$response, ?\\Throwable \$senderException): ?\\Throwable
    {
        return WethodRequestException::fromResponse(\$response, \$senderException);
    }

    /**
     * Build an offset paginator for any list (Paginatable) request.
     */
    public function paginate(Request \$request): Paginator
    {
        return new WethodPaginator(\$this, \$request);
    }

$connMethodsBlock
}

PHP;

file_put_contents("$root/src/Wethod.php", $connector);

/* --------------------- convert DTOs to readonly --------------------- */

$dtoFiles = glob("$root/src/Dto/*.php");
$dtoCount = 0;
foreach ($dtoFiles as $file) {
    $src = file_get_contents($file);
    if (! preg_match('/class\s+(\w+)\s+extends\s+SpatieData/', $src, $cm)) {
        continue;
    }
    $className = $cm[1];

    // Extract constructor params block.
    preg_match('/__construct\((.*?)\)\s*\{/s', $src, $pm);
    $paramsBlock = $pm[1] ?? '';

    $lines = preg_split('/\r?\n/', $paramsBlock);
    $pendingMap = null;
    $props = []; // [type, name, default, jsonKey]
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') {
            continue;
        }
        if (preg_match("/#\\[MapName\\('([^']+)'\\)\\]/", $line, $mm)) {
            $pendingMap = $mm[1];

            continue;
        }
        if (preg_match('/public\s+(\??[\w\\\\]+)\s+\$(\w+)\s*(?:=\s*(.+?))?,?$/', $line, $pp)) {
            $type = $pp[1];
            $name = $pp[2];
            $default = $pp[3] ?? null;
            $jsonKey = $pendingMap ?? $name;
            $props[] = [$type, $name, $default, $jsonKey];
            $pendingMap = null;
        }
    }

    // Build readonly constructor + from() + collect().
    $ctorLines = [];
    $fromLines = [];
    foreach ($props as [$type, $name, $default, $jsonKey]) {
        $def = $default !== null ? " = $default" : ' = null';
        $ctorLines[] = "        public $type \$$name$def,";
        $bare = ltrim($type, '?');
        if (str_ends_with($bare, 'Dto')) {
            $fromLines[] = "            $name: isset(\$data['$jsonKey']) ? {$bare}::from(\$data['$jsonKey']) : null,";
        } else {
            $fromLines[] = "            $name: \$data['$jsonKey'] ?? null,";
        }
    }
    $ctorBlock = implode("\n", $ctorLines);
    $fromBlock = implode("\n", $fromLines);

    $php = <<<PHP
    <?php

    namespace EnricoDeLazzari\\Wethod\\Dto;

    final readonly class $className
    {
        public function __construct(
    $ctorBlock
        ) {
        }

        /**
         * @param  array<string, mixed>  \$data
         */
        public static function from(array \$data): self
        {
            return new self(
    $fromBlock
            );
        }

        /**
         * @param  array<int, array<string, mixed>>  \$items
         * @return array<int, self>
         */
        public static function collect(array \$items): array
        {
            return array_map(static fn (array \$item): self => self::from(\$item), \$items);
        }
    }

    PHP;

    file_put_contents($file, $php);
    $dtoCount++;
}

echo "requests: $requestCount\n";
echo 'resources: '.count($accessors)."\n";
echo "dtos: $dtoCount\n";
