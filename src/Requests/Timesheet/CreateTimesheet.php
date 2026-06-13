<?php

namespace EnricoDeLazzari\Wethod\Requests\Timesheet;

use EnricoDeLazzari\Wethod\Dto\TimesheetDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a timesheet
 */
class CreateTimesheet extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/timesheets';
    }

    public function __construct(
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
