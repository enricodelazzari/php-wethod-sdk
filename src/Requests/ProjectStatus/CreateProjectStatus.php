<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectStatus;

use EnricoDeLazzari\Wethod\Dto\ProjectStatusDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a project status
 */
class CreateProjectStatus extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/project-statuses';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ProjectStatusDto
    {
        return ProjectStatusDto::from($response->json());
    }
}
