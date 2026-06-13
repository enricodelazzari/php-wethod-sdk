<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProductionDto;
use EnricoDeLazzari\Wethod\Requests\Production\ListProductions;
use Saloon\Http\BaseResource;

class Production extends BaseResource
{
    /**
     * @return array<int, ProductionDto>
     */
    public function listProductions(?int $projectId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListProductions($projectId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }
}
