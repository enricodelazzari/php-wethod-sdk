<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanTask;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanTaskDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project plan task
 */
class GetProjectPlanTask extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-tasks/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProjectPlanTaskDto
    {
        return ProjectPlanTaskDto::from($response->json());
    }
}
