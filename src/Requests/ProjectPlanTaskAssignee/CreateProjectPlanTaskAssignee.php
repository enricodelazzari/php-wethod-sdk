<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanTaskAssigneeDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a project plan task assignee (assign an employee to a task)
 */
class CreateProjectPlanTaskAssignee extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-task-assignees';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ProjectPlanTaskAssigneeDto
    {
        return ProjectPlanTaskAssigneeDto::from($response->json());
    }
}
