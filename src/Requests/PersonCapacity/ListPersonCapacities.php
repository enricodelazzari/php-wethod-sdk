<?php

namespace EnricoDeLazzari\Wethod\Requests\PersonCapacity;

use EnricoDeLazzari\Wethod\Dto\EmployeeWorkHourCapacityDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List person capacities
 */
class ListPersonCapacities extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/person-capacities';
    }

    public function __construct(
        protected ?int $personId = null,
        protected ?int $capacityId = null,
        protected ?string $order = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['person_id' => $this->personId, 'capacity_id' => $this->capacityId, 'order' => $this->order, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, EmployeeWorkHourCapacityDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return EmployeeWorkHourCapacityDto::collect($response->json());
    }
}
