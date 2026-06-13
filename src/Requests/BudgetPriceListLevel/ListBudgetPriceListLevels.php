<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetPriceListLevel;

use EnricoDeLazzari\Wethod\Dto\BudgetPriceListLevelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List budget price list levels
 */
class ListBudgetPriceListLevels extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/budget-price-list-levels';
    }

    public function __construct(
        protected ?int $budgetId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['budget_id' => $this->budgetId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, BudgetPriceListLevelDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return BudgetPriceListLevelDto::collect($response->json());
    }
}
