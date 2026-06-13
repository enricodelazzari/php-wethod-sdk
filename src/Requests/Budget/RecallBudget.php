<?php

namespace EnricoDeLazzari\Wethod\Requests\Budget;

use EnricoDeLazzari\Wethod\Dto\BudgetDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Recall a budget
 */
class RecallBudget extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/budgets/{$this->id}:recall";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BudgetDto
    {
        return BudgetDto::from($response->json());
    }
}
