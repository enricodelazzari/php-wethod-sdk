<?php

namespace EnricoDeLazzari\Wethod\Requests\Project;

use EnricoDeLazzari\Wethod\Dto\ProjectDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Archive a project
 */
class ArchiveProject extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/projects/{$this->id}:archive";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProjectDto
    {
        return ProjectDto::from($response->json());
    }
}
