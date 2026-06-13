<?php

namespace EnricoDeLazzari\Wethod\Requests\Holiday;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a holiday
 */
class DeleteHoliday extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/holidays/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
