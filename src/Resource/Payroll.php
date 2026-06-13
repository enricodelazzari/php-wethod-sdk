<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\EmployeePayrollDto;
use EnricoDeLazzari\Wethod\Requests\Payroll\CreatePersonPayroll;
use EnricoDeLazzari\Wethod\Requests\Payroll\DeletePersonPayroll;
use EnricoDeLazzari\Wethod\Requests\Payroll\GetPersonPayroll;
use EnricoDeLazzari\Wethod\Requests\Payroll\ListPersonPayrolls;
use EnricoDeLazzari\Wethod\Requests\Payroll\UpdatePersonPayroll;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Payroll extends BaseResource
{
    /**
     * @return array<int, EmployeePayrollDto>
     */
    public function listPersonPayrolls(?int $personId = null, ?int $businessUnitId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListPersonPayrolls($personId, $businessUnitId, $limit, $offset, $updatedAt))->dto();
    }

    public function createPersonPayroll(array $data = []): EmployeePayrollDto
    {
        return $this->connector->send(new CreatePersonPayroll($data))->dto();
    }

    public function getPersonPayroll(int $id): EmployeePayrollDto
    {
        return $this->connector->send(new GetPersonPayroll($id))->dto();
    }

    public function deletePersonPayroll(int $id): Response
    {
        return $this->connector->send(new DeletePersonPayroll($id));
    }

    public function updatePersonPayroll(int $id, array $data = []): EmployeePayrollDto
    {
        return $this->connector->send(new UpdatePersonPayroll($id, $data))->dto();
    }
}
