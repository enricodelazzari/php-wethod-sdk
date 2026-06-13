<?php

namespace EnricoDeLazzari\Wethod\Requests\Budget;

use EnricoDeLazzari\Wethod\Dto\BudgetDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Set the new budget baseline
 */
class SetBaseline extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/budgets/{$this->id}:set-baseline";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BudgetDto
    {
        return BudgetDto::from($response->json());
    }
}
