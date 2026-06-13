<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanTask;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanTaskDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project plan tasks
 */
class ListProjectPlanTasks extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-tasks';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $projectPlanAreaId = null,
        protected ?int $employeeId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'project_plan_area_id' => $this->projectPlanAreaId, 'employee_id' => $this->employeeId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProjectPlanTaskDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectPlanTaskDto::collect($response->json());
    }
}
