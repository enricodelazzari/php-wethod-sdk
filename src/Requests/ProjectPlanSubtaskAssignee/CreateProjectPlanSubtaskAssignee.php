<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskAssigneeDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a project plan subtask assignee (assign an employee to a subtask)
 */
class CreateProjectPlanSubtaskAssignee extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-subtask-assignees';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ProjectPlanSubtaskAssigneeDto
    {
        return ProjectPlanSubtaskAssigneeDto::from($response->json());
    }
}
