<?php

namespace EnricoDeLazzari\Wethod\Requests\PriceList;

use EnricoDeLazzari\Wethod\Dto\PriceListDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a price list
 */
class GetPriceList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/price-lists/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): PriceListDto
    {
        return PriceListDto::from($response->json());
    }
}
