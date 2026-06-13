<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductLevel;

use EnricoDeLazzari\Wethod\Dto\ProductLevelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List product levels
 */
class ListProductLevels extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/product-levels';
    }

    public function __construct(
        protected ?int $productId = null,
        protected ?int $levelId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['product_id' => $this->productId, 'level_id' => $this->levelId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProductLevelDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProductLevelDto::collect($response->json());
    }
}
