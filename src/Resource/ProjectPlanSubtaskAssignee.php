<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskAssigneeDto;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee\CreateProjectPlanSubtaskAssignee;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee\DeleteProjectPlanSubtaskAssignee;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee\GetProjectPlanSubtaskAssignee;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee\ListProjectPlanSubtaskAssignees;
use EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee\UpdateProjectPlanSubtaskAssignee;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProjectPlanSubtaskAssignee extends BaseResource
{
    /**
     * @return array<int, ProjectPlanSubtaskAssigneeDto>
     */
    public function listProjectPlanSubtaskAssignees(?int $employeeId = null, ?int $projectPlanSubtaskId = null, ?int $projectId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProjectPlanSubtaskAssignees($employeeId, $projectPlanSubtaskId, $projectId, $limit, $offset, $updatedAt))->dto();
    }

    public function createProjectPlanSubtaskAssignee(array $data = []): ProjectPlanSubtaskAssigneeDto
    {
        return $this->connector->send(new CreateProjectPlanSubtaskAssignee($data))->dto();
    }

    public function getProjectPlanSubtaskAssignee(int $id): ProjectPlanSubtaskAssigneeDto
    {
        return $this->connector->send(new GetProjectPlanSubtaskAssignee($id))->dto();
    }

    public function deleteProjectPlanSubtaskAssignee(int $id): Response
    {
        return $this->connector->send(new DeleteProjectPlanSubtaskAssignee($id));
    }

    public function updateProjectPlanSubtaskAssignee(int $id, array $data = []): ProjectPlanSubtaskAssigneeDto
    {
        return $this->connector->send(new UpdateProjectPlanSubtaskAssignee($id, $data))->dto();
    }
}
