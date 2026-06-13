<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetJobTitle;

use EnricoDeLazzari\Wethod\Dto\BudgetJobTitleDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a budget job title
 */
class GetBudgetJobTitle extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/budget-job-titles/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BudgetJobTitleDto
    {
        return BudgetJobTitleDto::from($response->json());
    }
}
