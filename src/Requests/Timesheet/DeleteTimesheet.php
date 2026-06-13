<?php

namespace EnricoDeLazzari\Wethod\Requests\Timesheet;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a timesheet
 */
class DeleteTimesheet extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/timesheets/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
