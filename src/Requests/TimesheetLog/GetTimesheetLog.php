<?php

namespace EnricoDeLazzari\Wethod\Requests\TimesheetLog;

use EnricoDeLazzari\Wethod\Dto\TimesheetLogDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a timesheet log
 */
class GetTimesheetLog extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/timesheet-logs/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): TimesheetLogDto
    {
        return TimesheetLogDto::from($response->json());
    }
}
