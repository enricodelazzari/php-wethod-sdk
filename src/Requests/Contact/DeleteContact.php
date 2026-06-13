<?php

namespace EnricoDeLazzari\Wethod\Requests\Contact;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a contact
 */
class DeleteContact extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/contact/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
