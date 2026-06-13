<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtaskAssignee;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project plan subtask assignee
 */
class DeleteProjectPlanSubtaskAssignee extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-subtask-assignees/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
