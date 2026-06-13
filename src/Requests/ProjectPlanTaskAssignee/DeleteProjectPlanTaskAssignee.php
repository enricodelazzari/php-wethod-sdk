<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanTaskAssignee;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project plan task assignee
 */
class DeleteProjectPlanTaskAssignee extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-task-assignees/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
