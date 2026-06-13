<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectTypeDto;
use EnricoDeLazzari\Wethod\Requests\JobOrderCategory\GetJobOrderCategory;
use EnricoDeLazzari\Wethod\Requests\JobOrderCategory\ListJobOrderCategories;
use Saloon\Http\BaseResource;

class JobOrderCategory extends BaseResource
{
    /**
     * @return array<int, ProjectTypeDto>
     */
    public function listJobOrderCategories(?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListJobOrderCategories($limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function getJobOrderCategory(int $id, ?string $deleted = null): ProjectTypeDto
    {
        return $this->connector->send(new GetJobOrderCategory($id, $deleted))->dto();
    }
}
