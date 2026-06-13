<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\BudgetJobTitleDto;
use EnricoDeLazzari\Wethod\Requests\BudgetJobTitle\GetBudgetJobTitle;
use EnricoDeLazzari\Wethod\Requests\BudgetJobTitle\ListBudgetJobTitles;
use Saloon\Http\BaseResource;

class BudgetJobTitle extends BaseResource
{
    /**
     * @return array<int, BudgetJobTitleDto>
     */
    public function listBudgetJobTitles(?int $budgetId = null, ?int $jobTitleId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListBudgetJobTitles($budgetId, $jobTitleId, $limit, $offset, $updatedAt))->dto();
    }

    public function getBudgetJobTitle(int $id): BudgetJobTitleDto
    {
        return $this->connector->send(new GetBudgetJobTitle($id))->dto();
    }
}
