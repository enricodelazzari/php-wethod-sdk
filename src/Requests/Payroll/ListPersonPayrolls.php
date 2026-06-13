<?php

namespace EnricoDeLazzari\Wethod\Requests\Payroll;

use EnricoDeLazzari\Wethod\Dto\EmployeePayrollDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List person payrolls
 */
class ListPersonPayrolls extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/person-payrolls';
    }

    public function __construct(
        protected ?int $personId = null,
        protected ?int $businessUnitId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['person_id' => $this->personId, 'business_unit_id' => $this->businessUnitId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, EmployeePayrollDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return EmployeePayrollDto::collect($response->json());
    }
}
