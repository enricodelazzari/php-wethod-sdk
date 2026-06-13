<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\PeopleAllocationDto;
use EnricoDeLazzari\Wethod\Requests\PeopleAllocation\CreatePeopleAllocation;
use EnricoDeLazzari\Wethod\Requests\PeopleAllocation\DeletePeopleAllocation;
use EnricoDeLazzari\Wethod\Requests\PeopleAllocation\ListPeopleAllocations;
use EnricoDeLazzari\Wethod\Requests\PeopleAllocation\UpdatePeopleAllocation;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class PeopleAllocation extends BaseResource
{
    /**
     * @return array<int, PeopleAllocationDto>
     */
    public function listPeopleAllocations(?string $date = null, ?int $projectId = null, ?int $personId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListPeopleAllocations($date, $projectId, $personId, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createPeopleAllocation(array $data = []): PeopleAllocationDto
    {
        return $this->connector->send(new CreatePeopleAllocation($data))->dto();
    }

    public function deletePeopleAllocation(int $id): Response
    {
        return $this->connector->send(new DeletePeopleAllocation($id));
    }

    public function updatePeopleAllocation(int $id, array $data = []): PeopleAllocationDto
    {
        return $this->connector->send(new UpdatePeopleAllocation($id, $data))->dto();
    }
}
