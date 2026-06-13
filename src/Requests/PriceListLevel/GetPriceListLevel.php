<?php

namespace EnricoDeLazzari\Wethod\Requests\PriceListLevel;

use EnricoDeLazzari\Wethod\Dto\PriceListLevelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a price list level
 */
class GetPriceListLevel extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/price-list-levels/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): PriceListLevelDto
    {
        return PriceListLevelDto::from($response->json());
    }
}
