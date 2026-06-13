<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetArea;

use EnricoDeLazzari\Wethod\Dto\BudgetAreaDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a budget area
 */
class GetBudgetArea extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/budget-areas/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BudgetAreaDto
    {
        return BudgetAreaDto::from($response->json());
    }
}
