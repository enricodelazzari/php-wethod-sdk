<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\EmployeeDto;
use EnricoDeLazzari\Wethod\Requests\Person\GetAuthenticatedPerson;
use EnricoDeLazzari\Wethod\Requests\Person\GetPerson;
use EnricoDeLazzari\Wethod\Requests\Person\ListPersons;
use EnricoDeLazzari\Wethod\Requests\Person\UpdatePerson;
use Saloon\Http\BaseResource;

class Person extends BaseResource
{
    /**
     * @return array<int, EmployeeDto>
     */
    public function listPersons(?int $jobTitleId = null, ?int $allocationManagerId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListPersons($jobTitleId, $allocationManagerId, $limit, $offset, $updatedAt))->dto();
    }

    public function getAuthenticatedPerson(): EmployeeDto
    {
        return $this->connector->send(new GetAuthenticatedPerson)->dto();
    }

    public function getPerson(int $id): EmployeeDto
    {
        return $this->connector->send(new GetPerson($id))->dto();
    }

    public function updatePerson(int $id, array $data = []): EmployeeDto
    {
        return $this->connector->send(new UpdatePerson($id, $data))->dto();
    }
}
