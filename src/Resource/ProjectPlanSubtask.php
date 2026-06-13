<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskDto;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask\CreateProjectPlanSubtask;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask\DeleteProjectPlanSubtask;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask\GetProjectPlanSubtask;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask\ListProjectPlanSubtasks;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask\UpdateProjectPlanSubtask;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProjectPlanSubtask extends BaseResource
{
    /**
     * @return array<int, ProjectPlanSubtaskDto>
     */
    public function listProjectPlanSubtasks(?int $projectId = null, ?int $projectPlanTaskId = null, ?int $employeeId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProjectPlanSubtasks($projectId, $projectPlanTaskId, $employeeId, $limit, $offset, $updatedAt))->dto();
    }

    public function createProjectPlanSubtask(array $data = []): ProjectPlanSubtaskDto
    {
        return $this->connector->send(new CreateProjectPlanSubtask($data))->dto();
    }

    public function getProjectPlanSubtask(int $id): ProjectPlanSubtaskDto
    {
        return $this->connector->send(new GetProjectPlanSubtask($id))->dto();
    }

    public function deleteProjectPlanSubtask(int $id): Response
    {
        return $this->connector->send(new DeleteProjectPlanSubtask($id));
    }

    public function updateProjectPlanSubtask(int $id, array $data = []): ProjectPlanSubtaskDto
    {
        return $this->connector->send(new UpdateProjectPlanSubtask($id, $data))->dto();
    }
}
