<?php

namespace EnricoDeLazzari\Wethod\Requests\Project;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project
 */
class DeleteProject extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/projects/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
