<?php

namespace EnricoDeLazzari\Wethod\Requests\Payroll;

use EnricoDeLazzari\Wethod\Dto\EmployeePayrollDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a person payroll
 */
class UpdatePersonPayroll extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/person-payrolls/{$this->id}";
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

    public function createDtoFromResponse(Response $response): EmployeePayrollDto
    {
        return EmployeePayrollDto::from($response->json());
    }
}
