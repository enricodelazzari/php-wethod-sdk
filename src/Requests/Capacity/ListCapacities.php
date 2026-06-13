<?php

namespace EnricoDeLazzari\Wethod\Requests\Capacity;

use EnricoDeLazzari\Wethod\Dto\WorkHourCapacityDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List capacities
 */
class ListCapacities extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/capacities';
    }

    public function __construct(
        protected ?string $order = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $isArchived = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['order' => $this->order, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'is_archived' => $this->isArchived, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, WorkHourCapacityDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return WorkHourCapacityDto::collect($response->json());
    }
}
