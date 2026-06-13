<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\BudgetDayDto;
use EnricoDeLazzari\Wethod\Requests\BudgetDay\GetBudgetDay;
use EnricoDeLazzari\Wethod\Requests\BudgetDay\ListBudgetDays;
use EnricoDeLazzari\Wethod\Requests\BudgetDay\UpdateBudgetDay;
use Saloon\Http\BaseResource;

class BudgetDay extends BaseResource
{
    /**
     * @return array<int, BudgetDayDto>
     */
    public function listBudgetDays(?int $budgetTaskId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListBudgetDays($budgetTaskId, $limit, $offset, $updatedAt))->dto();
    }

    public function getBudgetDay(int $id): BudgetDayDto
    {
        return $this->connector->send(new GetBudgetDay($id))->dto();
    }

    public function updateBudgetDay(int $id, array $data = []): BudgetDayDto
    {
        return $this->connector->send(new UpdateBudgetDay($id, $data))->dto();
    }
}
