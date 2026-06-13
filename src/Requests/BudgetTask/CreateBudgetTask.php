<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetTask;

use EnricoDeLazzari\Wethod\Dto\BudgetTaskDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a budget task
 */
class CreateBudgetTask extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/budget-tasks';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): BudgetTaskDto
    {
        return BudgetTaskDto::from($response->json());
    }
}
