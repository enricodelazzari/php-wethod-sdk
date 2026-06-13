<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectTypeGroupDto;
use EnricoDeLazzari\Wethod\Requests\JobOrderCategoryGroup\GetJobOrderCategoryGroup;
use EnricoDeLazzari\Wethod\Requests\JobOrderCategoryGroup\ListJobOrderCategoryGroups;
use Saloon\Http\BaseResource;

class JobOrderCategoryGroup extends BaseResource
{
    /**
     * @return array<int, ProjectTypeGroupDto>
     */
    public function listJobOrderCategoryGroups(?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListJobOrderCategoryGroups($limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function getJobOrderCategoryGroup(int $id, ?string $deleted = null): ProjectTypeGroupDto
    {
        return $this->connector->send(new GetJobOrderCategoryGroup($id, $deleted))->dto();
    }
}
