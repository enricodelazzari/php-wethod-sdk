<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\BudgetTaskDto;
use EnricoDeLazzari\Wethod\Requests\BudgetTask\CreateBudgetTask;
use EnricoDeLazzari\Wethod\Requests\BudgetTask\DeleteBudgetTask;
use EnricoDeLazzari\Wethod\Requests\BudgetTask\GetBudgetTask;
use EnricoDeLazzari\Wethod\Requests\BudgetTask\ListBudgetTasks;
use EnricoDeLazzari\Wethod\Requests\BudgetTask\UpdateBudgetTask;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class BudgetTask extends BaseResource
{
    /**
     * @return array<int, BudgetTaskDto>
     */
    public function listBudgetTasks(?int $budgetAreaId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListBudgetTasks($budgetAreaId, $limit, $offset, $updatedAt))->dto();
    }

    public function createBudgetTask(array $data = []): BudgetTaskDto
    {
        return $this->connector->send(new CreateBudgetTask($data))->dto();
    }

    public function getBudgetTask(int $id): BudgetTaskDto
    {
        return $this->connector->send(new GetBudgetTask($id))->dto();
    }

    public function deleteBudgetTask(int $id): Response
    {
        return $this->connector->send(new DeleteBudgetTask($id));
    }

    public function updateBudgetTask(int $id, array $data = []): BudgetTaskDto
    {
        return $this->connector->send(new UpdateBudgetTask($id, $data))->dto();
    }
}
