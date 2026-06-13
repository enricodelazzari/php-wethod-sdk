<?php

namespace EnricoDeLazzari\Wethod\Requests\Person;

use EnricoDeLazzari\Wethod\Dto\EmployeeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List persons
 */
class ListPersons extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/persons';
    }

    public function __construct(
        protected ?int $jobTitleId = null,
        protected ?int $allocationManagerId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['job_title_id' => $this->jobTitleId, 'allocation_manager_id' => $this->allocationManagerId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, EmployeeDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return EmployeeDto::collect($response->json());
    }
}
