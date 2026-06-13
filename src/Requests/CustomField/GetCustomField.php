<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomField;

use EnricoDeLazzari\Wethod\Dto\CustomFieldDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a custom field
 */
class GetCustomField extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/custom-fields/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): CustomFieldDto
    {
        return CustomFieldDto::from($response->json());
    }
}
