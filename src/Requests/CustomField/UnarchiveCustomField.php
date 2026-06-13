<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomField;

use EnricoDeLazzari\Wethod\Dto\CustomFieldDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Unarchive a custom field
 */
class UnarchiveCustomField extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/custom-fields/{$this->id}:unarchive";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): CustomFieldDto
    {
        return CustomFieldDto::from($response->json());
    }
}
