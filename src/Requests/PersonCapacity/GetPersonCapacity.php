<?php

namespace EnricoDeLazzari\Wethod\Requests\PersonCapacity;

use EnricoDeLazzari\Wethod\Dto\EmployeeWorkHourCapacityDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a person capacity
 */
class GetPersonCapacity extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/person-capacities/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): EmployeeWorkHourCapacityDto
    {
        return EmployeeWorkHourCapacityDto::from($response->json());
    }
}
