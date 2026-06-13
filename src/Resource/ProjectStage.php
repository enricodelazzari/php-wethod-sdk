<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectStageDto;
use EnricoDeLazzari\Wethod\Requests\ProjectStage\ListProjectStages;
use Saloon\Http\BaseResource;

class ProjectStage extends BaseResource
{
    /**
     * @return array<int, ProjectStageDto>
     */
    public function listProjectStages(?string $order = null, ?string $search = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProjectStages($order, $search, $limit, $offset, $updatedAt))->dto();
    }
}
