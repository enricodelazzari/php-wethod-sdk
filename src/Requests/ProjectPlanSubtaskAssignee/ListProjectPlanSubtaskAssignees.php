<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskAssigneeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project plan subtask assignees
 */
class ListProjectPlanSubtaskAssignees extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-subtask-assignees';
    }

    public function __construct(
        protected ?int $employeeId = null,
        protected ?int $projectPlanSubtaskId = null,
        protected ?int $projectId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['employee_id' => $this->employeeId, 'project_plan_subtask_id' => $this->projectPlanSubtaskId, 'project_id' => $this->projectId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProjectPlanSubtaskAssigneeDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectPlanSubtaskAssigneeDto::collect($response->json());
    }
}
