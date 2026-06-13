<?php

namespace EnricoDeLazzari\Wethod\Requests\TimesheetWhitelist;

use EnricoDeLazzari\Wethod\Dto\TimesheetWhitelistDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List timesheet whitelists
 */
class ListTimesheetWhitelists extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/timesheet-whitelists';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $personId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'person_id' => $this->personId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, TimesheetWhitelistDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return TimesheetWhitelistDto::collect($response->json());
    }
}
