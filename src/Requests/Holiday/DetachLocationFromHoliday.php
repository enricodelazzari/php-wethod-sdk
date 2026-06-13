<?php

namespace EnricoDeLazzari\Wethod\Requests\Holiday;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Detach location from holiday
 */
class DetachLocationFromHoliday extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/holidays/{$this->holidayId}/locations/{$this->locationId}";
    }

    public function __construct(
        protected string $holidayId,
        protected string $locationId,
    ) {}

}
