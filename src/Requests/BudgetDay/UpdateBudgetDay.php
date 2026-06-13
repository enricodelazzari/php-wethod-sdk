<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetDay;

use EnricoDeLazzari\Wethod\Dto\BudgetDayDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a budget day
 */
class UpdateBudgetDay extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/budget-days/{$this->id}";
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

    public function createDtoFromResponse(Response $response): BudgetDayDto
    {
        return BudgetDayDto::from($response->json());
    }
}
