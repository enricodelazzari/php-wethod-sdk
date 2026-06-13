<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectLabelDto;
use EnricoDeLazzari\Wethod\Requests\ProjectType\GetProjectType;
use EnricoDeLazzari\Wethod\Requests\ProjectType\ListProjectTypes;
use Saloon\Http\BaseResource;

class ProjectType extends BaseResource
{
    /**
     * @return array<int, ProjectLabelDto>
     */
    public function listProjectTypes(?string $order = null, ?string $search = null, ?string $group = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProjectTypes($order, $search, $group, $limit, $offset, $updatedAt))->dto();
    }

    public function getProjectType(int $id): ProjectLabelDto
    {
        return $this->connector->send(new GetProjectType($id))->dto();
    }
}
