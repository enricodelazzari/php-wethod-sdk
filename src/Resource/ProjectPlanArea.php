<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanAreaDto;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanArea\CreateProjectPlanArea;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanArea\DeleteProjectPlanArea;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanArea\GetProjectPlanArea;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanArea\ListProjectPlanAreas;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanArea\UpdateProjectPlanArea;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProjectPlanArea extends BaseResource
{
    /**
     * @return array<int, ProjectPlanAreaDto>
     */
    public function listProjectPlanAreas(?int $projectId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProjectPlanAreas($projectId, $limit, $offset, $updatedAt))->dto();
    }

    public function createProjectPlanArea(array $data = []): ProjectPlanAreaDto
    {
        return $this->connector->send(new CreateProjectPlanArea($data))->dto();
    }

    public function getProjectPlanArea(int $id): ProjectPlanAreaDto
    {
        return $this->connector->send(new GetProjectPlanArea($id))->dto();
    }

    public function deleteProjectPlanArea(int $id): Response
    {
        return $this->connector->send(new DeleteProjectPlanArea($id));
    }

    public function updateProjectPlanArea(int $id, array $data = []): ProjectPlanAreaDto
    {
        return $this->connector->send(new UpdateProjectPlanArea($id, $data))->dto();
    }
}
