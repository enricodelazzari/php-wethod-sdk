<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectStatusAreaDto;
use EnricoDeLazzari\Wethod\Dto\ProjectStatusDto;
use EnricoDeLazzari\Wethod\Requests\ProjectStatus\CreateProjectStatus;
use EnricoDeLazzari\Wethod\Requests\ProjectStatus\DeleteProjectStatus;
use EnricoDeLazzari\Wethod\Requests\ProjectStatus\GetProjectStatus;
use EnricoDeLazzari\Wethod\Requests\ProjectStatus\ListProjectStatusAreas;
use EnricoDeLazzari\Wethod\Requests\ProjectStatus\ListProjectStatuses;
use EnricoDeLazzari\Wethod\Requests\ProjectStatus\UpdateProjectStatus;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProjectStatus extends BaseResource
{
    /**
     * @return array<int, ProjectStatusAreaDto>
     */
    public function listProjectStatusAreas(?int $projectStatusId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListProjectStatusAreas($projectStatusId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    /**
     * @return array<int, ProjectStatusDto>
     */
    public function listProjectStatuses(?int $projectId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListProjectStatuses($projectId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createProjectStatus(array $data = []): ProjectStatusDto
    {
        return $this->connector->send(new CreateProjectStatus($data))->dto();
    }

    public function getProjectStatus(int $id, ?string $deleted = null): ProjectStatusDto
    {
        return $this->connector->send(new GetProjectStatus($id, $deleted))->dto();
    }

    public function deleteProjectStatus(int $id): Response
    {
        return $this->connector->send(new DeleteProjectStatus($id));
    }

    public function updateProjectStatus(int $id, array $data = []): ProjectStatusDto
    {
        return $this->connector->send(new UpdateProjectStatus($id, $data))->dto();
    }
}
