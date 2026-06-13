<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanTask;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project plan task
 */
class DeleteProjectPlanTask extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-tasks/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
