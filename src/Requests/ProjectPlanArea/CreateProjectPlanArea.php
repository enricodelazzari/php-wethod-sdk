<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanArea;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanAreaDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a project plan area
 */
class CreateProjectPlanArea extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-areas';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ProjectPlanAreaDto
    {
        return ProjectPlanAreaDto::from($response->json());
    }
}
