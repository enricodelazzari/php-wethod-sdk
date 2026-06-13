<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectType;

use EnricoDeLazzari\Wethod\Dto\ProjectLabelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project type
 */
class GetProjectType extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/project-types/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ProjectLabelDto
    {
        return ProjectLabelDto::from($response->json());
    }
}
