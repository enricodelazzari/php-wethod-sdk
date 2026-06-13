<?php

namespace EnricoDeLazzari\Wethod\Requests\Holiday;

use EnricoDeLazzari\Wethod\Dto\HolidayDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List holidays
 */
class ListHolidays extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/holidays';
    }

    public function __construct(
        protected ?int $locationId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['location_id' => $this->locationId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, HolidayDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return HolidayDto::collect($response->json());
    }
}
