<?php

namespace EnricoDeLazzari\Wethod\Requests\Location;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a location
 */
class DeleteLocation extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/locations/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
