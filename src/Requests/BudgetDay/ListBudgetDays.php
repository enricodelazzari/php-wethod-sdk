<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetDay;

use EnricoDeLazzari\Wethod\Dto\BudgetDayDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List budget days
 */
class ListBudgetDays extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/budget-days';
    }

    public function __construct(
        protected ?int $budgetTaskId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['budget_task_id' => $this->budgetTaskId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, BudgetDayDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return BudgetDayDto::collect($response->json());
    }
}
