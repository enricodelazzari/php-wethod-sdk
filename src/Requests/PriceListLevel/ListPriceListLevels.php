<?php

namespace EnricoDeLazzari\Wethod\Requests\PriceListLevel;

use EnricoDeLazzari\Wethod\Dto\PriceListLevelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List price list levels
 */
class ListPriceListLevels extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/price-list-levels';
    }

    public function __construct(
        protected ?int $priceListId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['price_list_id' => $this->priceListId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, PriceListLevelDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return PriceListLevelDto::collect($response->json());
    }
}
