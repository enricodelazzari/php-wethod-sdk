<?php

namespace EnricoDeLazzari\Wethod\Requests\BudgetTask;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a budget task
 */
class DeleteBudgetTask extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/budget-tasks/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
