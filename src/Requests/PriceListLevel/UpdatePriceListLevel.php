<?php

namespace EnricoDeLazzari\Wethod\Requests\PriceListLevel;

use EnricoDeLazzari\Wethod\Dto\PriceListLevelDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a price list level
 */
class UpdatePriceListLevel extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/price-list-levels/{$this->id}";
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

    public function createDtoFromResponse(Response $response): PriceListLevelDto
    {
        return PriceListLevelDto::from($response->json());
    }
}
