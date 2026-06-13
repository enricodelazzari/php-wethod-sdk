<?php

namespace EnricoDeLazzari\Wethod\Requests\Holiday;

use EnricoDeLazzari\Wethod\Dto\HolidayLocationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List holiday locations
 */
class ListHolidayLocations extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/holidays/{$this->holidayId}/locations";
    }

    public function __construct(
        protected string $holidayId,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, HolidayLocationDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return HolidayLocationDto::collect($response->json());
    }
}
