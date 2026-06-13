<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\JobTitleDto;
use EnricoDeLazzari\Wethod\Requests\JobTitle\GetJobTitle;
use EnricoDeLazzari\Wethod\Requests\JobTitle\ListJobTitles;
use Saloon\Http\BaseResource;

class JobTitle extends BaseResource
{
    /**
     * @return array<int, JobTitleDto>
     */
    public function listJobTitles(?int $levelId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListJobTitles($levelId, $limit, $offset, $updatedAt))->dto();
    }

    public function getJobTitle(int $id): JobTitleDto
    {
        return $this->connector->send(new GetJobTitle($id))->dto();
    }
}
