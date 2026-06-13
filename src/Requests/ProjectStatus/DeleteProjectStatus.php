<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectStatus;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project status
 */
class DeleteProjectStatus extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/project-statuses/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
