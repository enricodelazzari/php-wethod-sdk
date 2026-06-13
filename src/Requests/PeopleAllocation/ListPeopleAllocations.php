<?php

namespace EnricoDeLazzari\Wethod\Requests\PeopleAllocation;

use EnricoDeLazzari\Wethod\Dto\PeopleAllocationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List people allocations
 */
class ListPeopleAllocations extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/people-allocations';
    }

    public function __construct(
        protected ?string $date = null,
        protected ?int $projectId = null,
        protected ?int $personId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['date' => $this->date, 'project_id' => $this->projectId, 'person_id' => $this->personId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, PeopleAllocationDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return PeopleAllocationDto::collect($response->json());
    }
}
