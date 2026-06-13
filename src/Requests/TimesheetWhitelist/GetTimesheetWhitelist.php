<?php

namespace EnricoDeLazzari\Wethod\Requests\TimesheetWhitelist;

use EnricoDeLazzari\Wethod\Dto\TimesheetWhitelistDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a timesheet whitelist
 */
class GetTimesheetWhitelist extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/timesheet-whitelists/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): TimesheetWhitelistDto
    {
        return TimesheetWhitelistDto::from($response->json());
    }
}
