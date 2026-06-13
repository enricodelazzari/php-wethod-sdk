<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanArea;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project plan area
 */
class DeleteProjectPlanArea extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-areas/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
