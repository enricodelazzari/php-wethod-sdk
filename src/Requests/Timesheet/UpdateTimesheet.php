<?php

namespace EnricoDeLazzari\Wethod\Requests\Timesheet;

use EnricoDeLazzari\Wethod\Dto\TimesheetDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a timesheet
 */
class UpdateTimesheet extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/timesheets/{$this->id}";
    }

    public function __construct(
        protected int $id,
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): TimesheetDto
    {
        return TimesheetDto::from($response->json());
    }
}
