<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetPriceListLevel;

use EnricoDeLazzari\Wethod\Dto\BudgetPriceListLevelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a budget price list level
 */
class GetBudgetPriceListLevel extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/budget-price-list-levels/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BudgetPriceListLevelDto
    {
        return BudgetPriceListLevelDto::from($response->json());
    }
}
