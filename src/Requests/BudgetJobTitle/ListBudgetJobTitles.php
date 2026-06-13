<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetJobTitle;

use EnricoDeLazzari\Wethod\Dto\BudgetJobTitleDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List budget job titles
 */
class ListBudgetJobTitles extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/budget-job-titles';
    }

    public function __construct(
        protected ?int $budgetId = null,
        protected ?int $jobTitleId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['budget_id' => $this->budgetId, 'job_title_id' => $this->jobTitleId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, BudgetJobTitleDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return BudgetJobTitleDto::collect($response->json());
    }
}
