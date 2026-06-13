<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomField;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a custom field
 */
class DeleteCustomField extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/custom-fields/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
