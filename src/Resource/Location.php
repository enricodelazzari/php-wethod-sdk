<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\LocationDto;
use EnricoDeLazzari\Wethod\Requests\Location\CreateLocation;
use EnricoDeLazzari\Wethod\Requests\Location\DeleteLocation;
use EnricoDeLazzari\Wethod\Requests\Location\GetLocation;
use EnricoDeLazzari\Wethod\Requests\Location\ListLocations;
use EnricoDeLazzari\Wethod\Requests\Location\UpdateLocation;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Location extends BaseResource
{
    /**
     * @return array<int, LocationDto>
     */
    public function listLocations(?int $holidayId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListLocations($holidayId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createLocation(array $data = []): LocationDto
    {
        return $this->connector->send(new CreateLocation($data))->dto();
    }

    public function getLocation(int $id, ?string $deleted = null): LocationDto
    {
        return $this->connector->send(new GetLocation($id, $deleted))->dto();
    }

    public function deleteLocation(int $id): Response
    {
        return $this->connector->send(new DeleteLocation($id));
    }

    public function updateLocation(int $id, array $data = []): LocationDto
    {
        return $this->connector->send(new UpdateLocation($id, $data))->dto();
    }
}
