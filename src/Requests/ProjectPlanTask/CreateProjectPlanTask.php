<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanTask;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanTaskDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a project plan task
 */
class CreateProjectPlanTask extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-tasks';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ProjectPlanTaskDto
    {
        return ProjectPlanTaskDto::from($response->json());
    }
}
