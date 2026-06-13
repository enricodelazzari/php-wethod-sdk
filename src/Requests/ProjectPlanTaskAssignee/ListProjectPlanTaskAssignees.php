<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanTaskAssigneeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project plan task assignees
 */
class ListProjectPlanTaskAssignees extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-task-assignees';
    }

    public function __construct(
        protected ?int $employeeId = null,
        protected ?int $projectPlanTaskId = null,
        protected ?int $projectId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['employee_id' => $this->employeeId, 'project_plan_task_id' => $this->projectPlanTaskId, 'project_id' => $this->projectId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProjectPlanTaskAssigneeDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectPlanTaskAssigneeDto::collect($response->json());
    }
}
