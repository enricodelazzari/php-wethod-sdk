<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductLevel;

use EnricoDeLazzari\Wethod\Dto\ProductLevelDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a product level
 */
class UpdateProductLevel extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/product-levels/{$this->id}";
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

    public function createDtoFromResponse(Response $response): ProductLevelDto
    {
        return ProductLevelDto::from($response->json());
    }
}
