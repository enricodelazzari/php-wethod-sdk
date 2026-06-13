<?php

namespace EnricoDeLazzari\Wethod\Requests\TimesheetLog;

use EnricoDeLazzari\Wethod\Dto\TimesheetLogDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List timesheet logs
 */
class ListTimesheetLogs extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/timesheet-logs';
    }

    public function __construct(
        protected ?int $personId = null,
        protected ?string $date = null,
        protected ?int $projectId = null,
        protected ?int $toProjectId = null,
        protected ?string $mode = null,
        protected ?string $order = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['person_id' => $this->personId, 'date' => $this->date, 'project_id' => $this->projectId, 'to_project_id' => $this->toProjectId, 'mode' => $this->mode, 'order' => $this->order, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, TimesheetLogDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return TimesheetLogDto::collect($response->json());
    }
}
