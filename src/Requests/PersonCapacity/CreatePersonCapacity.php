<?php

namespace EnricoDeLazzari\Wethod\Requests\PersonCapacity;

use EnricoDeLazzari\Wethod\Dto\EmployeeWorkHourCapacityDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a person capacity
 */
class CreatePersonCapacity extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/person-capacities';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): EmployeeWorkHourCapacityDto
    {
        return EmployeeWorkHourCapacityDto::from($response->json());
    }
}
