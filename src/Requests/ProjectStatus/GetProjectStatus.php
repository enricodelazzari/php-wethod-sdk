<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectStatus;

use EnricoDeLazzari\Wethod\Dto\ProjectStatusDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project status
 */
class GetProjectStatus extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/project-statuses/{$this->id}";
    }

    public function __construct(
        protected int $id,
        protected ?string $deleted = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['deleted' => $this->deleted]);
    }

    public function createDtoFromResponse(Response $response): ProjectStatusDto
    {
        return ProjectStatusDto::from($response->json());
    }
}
