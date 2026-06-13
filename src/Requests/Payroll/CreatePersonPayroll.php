<?php

namespace EnricoDeLazzari\Wethod\Requests\Payroll;

use EnricoDeLazzari\Wethod\Dto\EmployeePayrollDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a person payroll
 */
class CreatePersonPayroll extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/person-payrolls';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): EmployeePayrollDto
    {
        return EmployeePayrollDto::from($response->json());
    }
}
