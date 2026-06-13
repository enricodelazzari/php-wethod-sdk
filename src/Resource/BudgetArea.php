<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\BudgetAreaDto;
use EnricoDeLazzari\Wethod\Requests\BudgetArea\CreateBudgetArea;
use EnricoDeLazzari\Wethod\Requests\BudgetArea\GetBudgetArea;
use EnricoDeLazzari\Wethod\Requests\BudgetArea\ListBudgetAreas;
use EnricoDeLazzari\Wethod\Requests\BudgetArea\UpdateBudgetArea;
use Saloon\Http\BaseResource;

class BudgetArea extends BaseResource
{
    /**
     * @return array<int, BudgetAreaDto>
     */
    public function listBudgetAreas(?int $budgetId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListBudgetAreas($budgetId, $limit, $offset, $updatedAt))->dto();
    }

    public function createBudgetArea(array $data = []): BudgetAreaDto
    {
        return $this->connector->send(new CreateBudgetArea($data))->dto();
    }

    public function getBudgetArea(int $id): BudgetAreaDto
    {
        return $this->connector->send(new GetBudgetArea($id))->dto();
    }

    public function updateBudgetArea(int $id, array $data = []): BudgetAreaDto
    {
        return $this->connector->send(new UpdateBudgetArea($id, $data))->dto();
    }
}
