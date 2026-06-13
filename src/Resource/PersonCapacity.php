<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\EmployeeWorkHourCapacityDto;
use EnricoDeLazzari\Wethod\Requests\PersonCapacity\CreatePersonCapacity;
use EnricoDeLazzari\Wethod\Requests\PersonCapacity\DeletePersonCapacity;
use EnricoDeLazzari\Wethod\Requests\PersonCapacity\GetPersonCapacity;
use EnricoDeLazzari\Wethod\Requests\PersonCapacity\ListPersonCapacities;
use EnricoDeLazzari\Wethod\Requests\PersonCapacity\UpdatePersonCapacity;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class PersonCapacity extends BaseResource
{
    /**
     * @return array<int, EmployeeWorkHourCapacityDto>
     */
    public function listPersonCapacities(?int $personId = null, ?int $capacityId = null, ?string $order = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListPersonCapacities($personId, $capacityId, $order, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createPersonCapacity(array $data = []): EmployeeWorkHourCapacityDto
    {
        return $this->connector->send(new CreatePersonCapacity($data))->dto();
    }

    public function getPersonCapacity(int $id): EmployeeWorkHourCapacityDto
    {
        return $this->connector->send(new GetPersonCapacity($id))->dto();
    }

    public function deletePersonCapacity(int $id): Response
    {
        return $this->connector->send(new DeletePersonCapacity($id));
    }

    public function updatePersonCapacity(int $id, array $data = []): EmployeeWorkHourCapacityDto
    {
        return $this->connector->send(new UpdatePersonCapacity($id, $data))->dto();
    }
}
