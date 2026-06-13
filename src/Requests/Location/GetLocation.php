<?php

namespace EnricoDeLazzari\Wethod\Requests\Location;

use EnricoDeLazzari\Wethod\Dto\LocationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a location
 */
class GetLocation extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/locations/{$this->id}";
    }

    public function __construct(
        protected int $id,
        protected ?string $deleted = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['deleted' => $this->deleted]);
    }

    public function createDtoFromResponse(Response $response): LocationDto
    {
        return LocationDto::from($response->json());
    }
}
