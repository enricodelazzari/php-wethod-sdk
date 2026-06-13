<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskAssigneeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project plan subtask assignee
 */
class GetProjectPlanSubtaskAssignee extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-subtask-assignees/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProjectPlanSubtaskAssigneeDto
    {
        return ProjectPlanSubtaskAssigneeDto::from($response->json());
    }
}
