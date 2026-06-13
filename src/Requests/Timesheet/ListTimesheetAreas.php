<?php

namespace EnricoDeLazzari\Wethod\Requests\Timesheet;

use EnricoDeLazzari\Wethod\Dto\TimesheetAreaDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List timesheet areas
 */
class ListTimesheetAreas extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/timesheet-areas';
    }

    public function __construct(
        protected ?int $timesheetId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['timesheet_id' => $this->timesheetId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, TimesheetAreaDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return TimesheetAreaDto::collect($response->json());
    }
}
