<?php

namespace EnricoDeLazzari\Wethod\Requests\PeopleAllocation;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a person allocation
 */
class DeletePeopleAllocation extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/people-allocations/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
