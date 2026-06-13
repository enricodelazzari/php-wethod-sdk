<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomFieldOption;

use EnricoDeLazzari\Wethod\Dto\CustomFieldOptionDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a custom field option
 */
class UpdateCustomFieldOption extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/custom-field-options/{$this->id}";
    }

    public function __construct(
        protected int $id,
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): CustomFieldOptionDto
    {
        return CustomFieldOptionDto::from($response->json());
    }
}
