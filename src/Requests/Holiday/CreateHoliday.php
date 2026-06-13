<?php

namespace EnricoDeLazzari\Wethod\Requests\Holiday;

use EnricoDeLazzari\Wethod\Dto\HolidayDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a holiday
 */
class CreateHoliday extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/holidays';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): HolidayDto
    {
        return HolidayDto::from($response->json());
    }
}
