<?php

namespace EnricoDeLazzari\Wethod\Requests\Product;

use EnricoDeLazzari\Wethod\Dto\ProductDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a product
 */
class GetProduct extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/products/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProductDto
    {
        return ProductDto::from($response->json());
    }
}
