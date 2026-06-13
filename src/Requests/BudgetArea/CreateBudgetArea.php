<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetArea;

use EnricoDeLazzari\Wethod\Dto\BudgetAreaDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a budget area
 */
class CreateBudgetArea extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/budget-areas';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): BudgetAreaDto
    {
        return BudgetAreaDto::from($response->json());
    }
}
