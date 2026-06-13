<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomFieldOption;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete a custom field option
 */
class DeleteCustomFieldOption extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/custom-field-options/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
