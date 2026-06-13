<?php

namespace EnricoDeLazzari\Wethod\Requests\Location;

use EnricoDeLazzari\Wethod\Dto\LocationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List locations
 */
class ListLocations extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/locations';
    }

    public function __construct(
        protected ?int $holidayId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['holiday_id' => $this->holidayId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, LocationDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return LocationDto::collect($response->json());
    }
}
