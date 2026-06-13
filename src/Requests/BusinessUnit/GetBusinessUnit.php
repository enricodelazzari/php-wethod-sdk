<?php

namespace EnricoDeLazzari\Wethod\Requests\BusinessUnit;

use EnricoDeLazzari\Wethod\Dto\BusinessUnitDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a business unit
 */
class GetBusinessUnit extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/business-units/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): BusinessUnitDto
    {
        return BusinessUnitDto::from($response->json());
    }
}
