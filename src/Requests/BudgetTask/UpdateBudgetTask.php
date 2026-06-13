<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetTask;

use EnricoDeLazzari\Wethod\Dto\BudgetTaskDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a budget task
 */
class UpdateBudgetTask extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/budget-tasks/{$this->id}";
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

    public function createDtoFromResponse(Response $response): BudgetTaskDto
    {
        return BudgetTaskDto::from($response->json());
    }
}
