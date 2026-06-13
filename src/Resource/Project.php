<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectDto;
use EnricoDeLazzari\Wethod\Requests\Project\ArchiveProject;
use EnricoDeLazzari\Wethod\Requests\Project\CreateProject;
use EnricoDeLazzari\Wethod\Requests\Project\DeleteProject;
use EnricoDeLazzari\Wethod\Requests\Project\GetProject;
use EnricoDeLazzari\Wethod\Requests\Project\ListProjects;
use EnricoDeLazzari\Wethod\Requests\Project\UnarchiveProject;
use EnricoDeLazzari\Wethod\Requests\Project\UpdateProject;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Project extends BaseResource
{
    /**
     * @return array<int, ProjectDto>
     */
    public function listProjects(?int $probability = null, ?int $projectStageId = null, ?string $dateStart = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListProjects($probability, $projectStageId, $dateStart, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createProject(array $data = []): ProjectDto
    {
        return $this->connector->send(new CreateProject($data))->dto();
    }

    public function getProject(int $id): ProjectDto
    {
        return $this->connector->send(new GetProject($id))->dto();
    }

    public function deleteProject(int $id): Response
    {
        return $this->connector->send(new DeleteProject($id));
    }

    public function updateProject(int $id, array $data = []): ProjectDto
    {
        return $this->connector->send(new UpdateProject($id, $data))->dto();
    }

    public function archiveProject(int $id): ProjectDto
    {
        return $this->connector->send(new ArchiveProject($id))->dto();
    }

    public function unarchiveProject(int $id): ProjectDto
    {
        return $this->connector->send(new UnarchiveProject($id))->dto();
    }
}
