<?php

namespace EnricoDeLazzari\Wethod\Requests\Client;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a client
 */
class DeleteClient extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/client/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
