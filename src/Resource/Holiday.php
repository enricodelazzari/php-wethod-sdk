<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\HolidayDto;
use EnricoDeLazzari\Wethod\Dto\HolidayLocationDto;
use EnricoDeLazzari\Wethod\Requests\Holiday\AttachLocationToHoliday;
use EnricoDeLazzari\Wethod\Requests\Holiday\CreateHoliday;
use EnricoDeLazzari\Wethod\Requests\Holiday\DeleteHoliday;
use EnricoDeLazzari\Wethod\Requests\Holiday\DetachLocationFromHoliday;
use EnricoDeLazzari\Wethod\Requests\Holiday\GetHoliday;
use EnricoDeLazzari\Wethod\Requests\Holiday\ListHolidayLocations;
use EnricoDeLazzari\Wethod\Requests\Holiday\ListHolidays;
use EnricoDeLazzari\Wethod\Requests\Holiday\UpdateHoliday;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Holiday extends BaseResource
{
    /**
     * @return array<int, HolidayDto>
     */
    public function listHolidays(?int $locationId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListHolidays($locationId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createHoliday(array $data = []): HolidayDto
    {
        return $this->connector->send(new CreateHoliday($data))->dto();
    }

    public function getHoliday(int $id, ?string $deleted = null): HolidayDto
    {
        return $this->connector->send(new GetHoliday($id, $deleted))->dto();
    }

    public function deleteHoliday(int $id): Response
    {
        return $this->connector->send(new DeleteHoliday($id));
    }

    public function updateHoliday(int $id, array $data = []): HolidayDto
    {
        return $this->connector->send(new UpdateHoliday($id, $data))->dto();
    }

    /**
     * @return array<int, HolidayLocationDto>
     */
    public function listHolidayLocations(string $holidayId, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListHolidayLocations($holidayId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function attachLocationToHoliday(string $holidayId, string $locationId): HolidayLocationDto
    {
        return $this->connector->send(new AttachLocationToHoliday($holidayId, $locationId))->dto();
    }

    public function detachLocationFromHoliday(string $holidayId, string $locationId): Response
    {
        return $this->connector->send(new DetachLocationFromHoliday($holidayId, $locationId));
    }
}
