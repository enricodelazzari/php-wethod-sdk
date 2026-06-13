<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanTaskAssigneeDto;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee\CreateProjectPlanTaskAssignee;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee\DeleteProjectPlanTaskAssignee;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee\GetProjectPlanTaskAssignee;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee\ListProjectPlanTaskAssignees;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee\UpdateProjectPlanTaskAssignee;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProjectPlanTaskAssignee extends BaseResource
{
    /**
     * @return array<int, ProjectPlanTaskAssigneeDto>
     */
    public function listProjectPlanTaskAssignees(?int $employeeId = null, ?int $projectPlanTaskId = null, ?int $projectId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProjectPlanTaskAssignees($employeeId, $projectPlanTaskId, $projectId, $limit, $offset, $updatedAt))->dto();
    }

    public function createProjectPlanTaskAssignee(array $data = []): ProjectPlanTaskAssigneeDto
    {
        return $this->connector->send(new CreateProjectPlanTaskAssignee($data))->dto();
    }

    public function getProjectPlanTaskAssignee(int $id): ProjectPlanTaskAssigneeDto
    {
        return $this->connector->send(new GetProjectPlanTaskAssignee($id))->dto();
    }

    public function deleteProjectPlanTaskAssignee(int $id): Response
    {
        return $this->connector->send(new DeleteProjectPlanTaskAssignee($id));
    }

    public function updateProjectPlanTaskAssignee(int $id, array $data = []): ProjectPlanTaskAssigneeDto
    {
        return $this->connector->send(new UpdateProjectPlanTaskAssignee($id, $data))->dto();
    }
}
