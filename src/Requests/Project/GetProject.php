<?php

namespace EnricoDeLazzari\Wethod\Requests\Project;

use EnricoDeLazzari\Wethod\Dto\ProjectDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project
 */
class GetProject extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/projects/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProjectDto
    {
        return ProjectDto::from($response->json());
    }
}
