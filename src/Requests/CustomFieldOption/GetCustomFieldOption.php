<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomFieldOption;

use EnricoDeLazzari\Wethod\Dto\CustomFieldOptionDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a custom field option
 */
class GetCustomFieldOption extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/custom-field-options/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): CustomFieldOptionDto
    {
        return CustomFieldOptionDto::from($response->json());
    }
}
