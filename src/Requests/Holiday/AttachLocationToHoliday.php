<?php

namespace EnricoDeLazzari\Wethod\Requests\Holiday;

use EnricoDeLazzari\Wethod\Dto\HolidayLocationDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Attach location to holiday
 */
class AttachLocationToHoliday extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/holidays/{$this->holidayId}/locations/{$this->locationId}";
    }

    public function __construct(
        protected string $holidayId,
        protected string $locationId,
    ) {}

    public function createDtoFromResponse(Response $response): HolidayLocationDto
    {
        return HolidayLocationDto::from($response->json());
    }
}
