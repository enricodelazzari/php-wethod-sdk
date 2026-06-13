<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetTask;

use EnricoDeLazzari\Wethod\Dto\BudgetTaskDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List budget tasks
 */
class ListBudgetTasks extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/budget-tasks';
    }

    public function __construct(
        protected ?int $budgetAreaId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['budget_area_id' => $this->budgetAreaId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, BudgetTaskDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return BudgetTaskDto::collect($response->json());
    }
}
