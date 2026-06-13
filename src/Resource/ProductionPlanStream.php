<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProductionPlanStreamDto;
use EnricoDeLazzari\Wethod\Requests\ProductionPlanStream\GetProductionPlanStream;
use EnricoDeLazzari\Wethod\Requests\ProductionPlanStream\ListProductionPlanStreams;
use Saloon\Http\BaseResource;

class ProductionPlanStream extends BaseResource
{
    /**
     * @return array<int, ProductionPlanStreamDto>
     */
    public function listProductionPlanStreams(?int $projectId = null, ?int $streamId = null, ?int $productionPlanId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListProductionPlanStreams($projectId, $streamId, $productionPlanId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function getProductionPlanStream(int $id, ?string $deleted = null): ProductionPlanStreamDto
    {
        return $this->connector->send(new GetProductionPlanStream($id, $deleted))->dto();
    }
}
