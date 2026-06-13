<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductLevel;

use EnricoDeLazzari\Wethod\Dto\ProductLevelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a product level
 */
class GetProductLevel extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/product-levels/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProductLevelDto
    {
        return ProductLevelDto::from($response->json());
    }
}
