<?php

namespace EnricoDeLazzari\Wethod\Requests\PersonCapacity;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a person capacity
 */
class DeletePersonCapacity extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/person-capacities/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
