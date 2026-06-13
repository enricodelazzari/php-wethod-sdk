<?php

namespace EnricoDeLazzari\Wethod\Requests\Product;

use EnricoDeLazzari\Wethod\Dto\ProductDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List products
 */
class ListProducts extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/products';
    }

    public function __construct(
        protected ?string $availableFrom = null,
        protected ?string $availableTo = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['available_from' => $this->availableFrom, 'available_to' => $this->availableTo, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProductDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProductDto::collect($response->json());
    }
}
