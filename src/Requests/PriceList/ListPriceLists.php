<?php

namespace EnricoDeLazzari\Wethod\Requests\PriceList;

use EnricoDeLazzari\Wethod\Dto\PriceListDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List price lists
 */
class ListPriceLists extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/price-lists';
    }

    public function __construct(
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, PriceListDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return PriceListDto::collect($response->json());
    }
}
