<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanArea;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanAreaDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project plan area
 */
class GetProjectPlanArea extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-areas/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProjectPlanAreaDto
    {
        return ProjectPlanAreaDto::from($response->json());
    }
}
