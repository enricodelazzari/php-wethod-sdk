<?php

namespace EnricoDeLazzari\Wethod\Requests\Timesheet;

use EnricoDeLazzari\Wethod\Dto\TimesheetDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List timesheets
 */
class ListTimesheets extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/timesheets';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $personId = null,
        protected ?string $date = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'person_id' => $this->personId, 'date' => $this->date, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, TimesheetDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return TimesheetDto::collect($response->json());
    }
}
