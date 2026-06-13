<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanSubtask;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanSubtaskDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a project plan subtask
 */
class UpdateProjectPlanSubtask extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/project-plan-subtasks/{$this->id}";
    }

    public function __construct(
        protected int $id,
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ProjectPlanSubtaskDto
    {
        return ProjectPlanSubtaskDto::from($response->json());
    }
}
