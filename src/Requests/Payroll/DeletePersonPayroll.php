<?php

namespace EnricoDeLazzari\Wethod\Requests\Payroll;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a person payroll
 */
class DeletePersonPayroll extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/person-payrolls/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
