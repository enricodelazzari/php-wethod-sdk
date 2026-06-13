<?php

namespace EnricoDeLazzari\Wethod\Requests\Budget;

use EnricoDeLazzari\Wethod\Dto\BudgetDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a budget
 */
class CreateBudget extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/budgets';
    }

    public function __construct(
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
