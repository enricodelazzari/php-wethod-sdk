<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project plan subtasks
 */
class ListProjectPlanSubtasks extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-subtasks';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $projectPlanTaskId = null,
        protected ?int $employeeId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'project_plan_task_id' => $this->projectPlanTaskId, 'employee_id' => $this->employeeId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProjectPlanSubtaskDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectPlanSubtaskDto::collect($response->json());
    }
}
