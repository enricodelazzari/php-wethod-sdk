<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProductionStreamDto;
use EnricoDeLazzari\Wethod\Requests\ProductionStream\GetProductionStream;
use EnricoDeLazzari\Wethod\Requests\ProductionStream\ListProductionStreams;
use Saloon\Http\BaseResource;

class ProductionStream extends BaseResource
{
    /**
     * @return array<int, ProductionStreamDto>
     */
    public function listProductionStreams(?int $projectId = null, ?int $productionId = null, ?int $streamId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListProductionStreams($projectId, $productionId, $streamId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function getProductionStream(int $id, ?string $deleted = null): ProductionStreamDto
    {
        return $this->connector->send(new GetProductionStream($id, $deleted))->dto();
    }
}
