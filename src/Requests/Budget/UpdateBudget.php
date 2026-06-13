<?php

namespace EnricoDeLazzari\Wethod\Requests\Budget;

use EnricoDeLazzari\Wethod\Dto\BudgetDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a budget
 */
class UpdateBudget extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/budgets/{$this->id}";
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

    public function createDtoFromResponse(Response $response): BudgetDto
    {
        return BudgetDto::from($response->json());
    }
}
