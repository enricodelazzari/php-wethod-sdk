<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanTaskDto;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTask\CreateProjectPlanTask;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTask\DeleteProjectPlanTask;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTask\GetProjectPlanTask;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTask\ListProjectPlanTasks;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTask\UpdateProjectPlanTask;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProjectPlanTask extends BaseResource
{
    /**
     * @return array<int, ProjectPlanTaskDto>
     */
    public function listProjectPlanTasks(?int $projectId = null, ?int $projectPlanAreaId = null, ?int $employeeId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProjectPlanTasks($projectId, $projectPlanAreaId, $employeeId, $limit, $offset, $updatedAt))->dto();
    }

    public function createProjectPlanTask(array $data = []): ProjectPlanTaskDto
    {
        return $this->connector->send(new CreateProjectPlanTask($data))->dto();
    }

    public function getProjectPlanTask(int $id): ProjectPlanTaskDto
    {
        return $this->connector->send(new GetProjectPlanTask($id))->dto();
    }

    public function deleteProjectPlanTask(int $id): Response
    {
        return $this->connector->send(new DeleteProjectPlanTask($id));
    }

    public function updateProjectPlanTask(int $id, array $data = []): ProjectPlanTaskDto
    {
        return $this->connector->send(new UpdateProjectPlanTask($id, $data))->dto();
    }
}
