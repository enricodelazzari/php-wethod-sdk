<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectMetadata;

use EnricoDeLazzari\Wethod\Dto\MetadataDTO;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a project metadata
 */
class UpdateMetadata extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/project-metadata/{$this->id}";
    }

    public function __construct(
        protected int $id,
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): MetadataDTO
    {
        return MetadataDTO::from($response->json());
    }
}
