<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomField;

use EnricoDeLazzari\Wethod\Dto\CustomFieldDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Archive a custom field
 */
class ArchiveCustomField extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/custom-fields/{$this->id}:archive";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): CustomFieldDto
    {
        return CustomFieldDto::from($response->json());
    }
}
