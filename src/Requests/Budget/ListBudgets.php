<?php

namespace EnricoDeLazzari\Wethod\Requests\Budget;

use EnricoDeLazzari\Wethod\Dto\BudgetDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List budgets
 */
class ListBudgets extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/budgets';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, BudgetDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return BudgetDto::collect($response->json());
    }
}
