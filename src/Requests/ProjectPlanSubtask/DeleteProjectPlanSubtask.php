<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project plan subtask
 */
class DeleteProjectPlanSubtask extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-subtasks/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
