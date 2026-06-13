<?php

namespace EnricoDeLazzari\Wethod\Requests\Payroll;

use EnricoDeLazzari\Wethod\Dto\EmployeePayrollDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a person payroll
 */
class GetPersonPayroll extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/person-payrolls/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): EmployeePayrollDto
    {
        return EmployeePayrollDto::from($response->json());
    }
}
