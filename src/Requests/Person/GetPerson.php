<?php

namespace EnricoDeLazzari\Wethod\Requests\Person;

use EnricoDeLazzari\Wethod\Dto\EmployeeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a person
 */
class GetPerson extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/persons/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): EmployeeDto
    {
        return EmployeeDto::from($response->json());
    }
}
