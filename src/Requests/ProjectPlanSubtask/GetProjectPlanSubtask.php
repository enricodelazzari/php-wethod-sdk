<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project plan subtask
 */
class GetProjectPlanSubtask extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-subtasks/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProjectPlanSubtaskDto
    {
        return ProjectPlanSubtaskDto::from($response->json());
    }
}
