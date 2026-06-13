<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectMetadata;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a project metadata
 */
class DeleteMetadata extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/project-metadata/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
