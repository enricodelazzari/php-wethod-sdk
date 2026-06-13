<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProductionPlanDto;
use EnricoDeLazzari\Wethod\Requests\ProductionPlan\ListProductionPlans;
use Saloon\Http\BaseResource;

class ProductionPlan extends BaseResource
{
    /**
     * @return array<int, ProductionPlanDto>
     */
    public function listProductionPlans(?int $projectId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListProductionPlans($projectId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }
}
