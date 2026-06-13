<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetTask;

use EnricoDeLazzari\Wethod\Dto\BudgetTaskDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a budget task
 */
class GetBudgetTask extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/budget-tasks/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BudgetTaskDto
    {
        return BudgetTaskDto::from($response->json());
    }
}
