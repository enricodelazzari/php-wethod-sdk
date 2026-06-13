<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\BudgetPriceListLevelDto;
use EnricoDeLazzari\Wethod\Requests\BudgetPriceListLevel\GetBudgetPriceListLevel;
use EnricoDeLazzari\Wethod\Requests\BudgetPriceListLevel\ListBudgetPriceListLevels;
use Saloon\Http\BaseResource;

class BudgetPriceListLevel extends BaseResource
{
    /**
     * @return array<int, BudgetPriceListLevelDto>
     */
    public function listBudgetPriceListLevels(?int $budgetId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListBudgetPriceListLevels($budgetId, $limit, $offset, $updatedAt))->dto();
    }

    public function getBudgetPriceListLevel(int $id): BudgetPriceListLevelDto
    {
        return $this->connector->send(new GetBudgetPriceListLevel($id))->dto();
    }
}
