<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetDay;

use EnricoDeLazzari\Wethod\Dto\BudgetDayDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a budget day
 */
class GetBudgetDay extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/budget-days/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BudgetDayDto
    {
        return BudgetDayDto::from($response->json());
    }
}
