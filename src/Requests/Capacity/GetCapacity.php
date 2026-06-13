<?php

namespace EnricoDeLazzari\Wethod\Requests\Capacity;

use EnricoDeLazzari\Wethod\Dto\WorkHourCapacityDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a capacity
 */
class GetCapacity extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/capacities/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): WorkHourCapacityDto
    {
        return WorkHourCapacityDto::from($response->json());
    }
}
