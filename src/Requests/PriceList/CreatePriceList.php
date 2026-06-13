<?php

namespace EnricoDeLazzari\Wethod\Requests\PriceList;

use EnricoDeLazzari\Wethod\Dto\PriceListDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a price list
 */
class CreatePriceList extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/price-lists';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): PriceListDto
    {
        return PriceListDto::from($response->json());
    }
}
