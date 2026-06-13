<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\BudgetDto;
use EnricoDeLazzari\Wethod\Requests\Budget\ApproveBudget;
use EnricoDeLazzari\Wethod\Requests\Budget\CreateBudget;
use EnricoDeLazzari\Wethod\Requests\Budget\DraftBudget;
use EnricoDeLazzari\Wethod\Requests\Budget\GetBudget;
use EnricoDeLazzari\Wethod\Requests\Budget\ListBudgets;
use EnricoDeLazzari\Wethod\Requests\Budget\RecallBudget;
use EnricoDeLazzari\Wethod\Requests\Budget\RejectBudget;
use EnricoDeLazzari\Wethod\Requests\Budget\SetBaseline;
use EnricoDeLazzari\Wethod\Requests\Budget\SubmitBudget;
use EnricoDeLazzari\Wethod\Requests\Budget\UpdateBudget;
use Saloon\Http\BaseResource;

class Budget extends BaseResource
{
    public function approveBudget(int $id, array $data = []): BudgetDto
    {
        return $this->connector->send(new ApproveBudget($id, $data))->dto();
    }

    public function setBaseline(int $id): BudgetDto
    {
        return $this->connector->send(new SetBaseline($id))->dto();
    }

    /**
     * @return array<int, BudgetDto>
     */
    public function listBudgets(?int $projectId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListBudgets($projectId, $limit, $offset, $updatedAt))->dto();
    }

    public function createBudget(array $data = []): BudgetDto
    {
        return $this->connector->send(new CreateBudget($data))->dto();
    }

    public function getBudget(int $id): BudgetDto
    {
        return $this->connector->send(new GetBudget($id))->dto();
    }

    public function updateBudget(int $id, array $data = []): BudgetDto
    {
        return $this->connector->send(new UpdateBudget($id, $data))->dto();
    }

    public function draftBudget(int $id): BudgetDto
    {
        return $this->connector->send(new DraftBudget($id))->dto();
    }

    public function recallBudget(int $id): BudgetDto
    {
        return $this->connector->send(new RecallBudget($id))->dto();
    }

    public function rejectBudget(int $id, array $data = []): BudgetDto
    {
        return $this->connector->send(new RejectBudget($id, $data))->dto();
    }

    public function submitBudget(int $id, array $data = []): BudgetDto
    {
        return $this->connector->send(new SubmitBudget($id, $data))->dto();
    }
}
