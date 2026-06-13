<?php

namespace EnricoDeLazzari\Wethod\Requests\Person;

use EnricoDeLazzari\Wethod\Dto\EmployeeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get the authenticated person
 */
class GetAuthenticatedPerson extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/persons/me';
    }

    public function createDtoFromResponse(Response $response): EmployeeDto
    {
        return EmployeeDto::from($response->json());
    }
}
