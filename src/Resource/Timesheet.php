<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\TimesheetAreaDto;
use EnricoDeLazzari\Wethod\Dto\TimesheetDto;
use EnricoDeLazzari\Wethod\Requests\Timesheet\CreateTimesheet;
use EnricoDeLazzari\Wethod\Requests\Timesheet\DeleteTimesheet;
use EnricoDeLazzari\Wethod\Requests\Timesheet\ListTimesheetAreas;
use EnricoDeLazzari\Wethod\Requests\Timesheet\ListTimesheets;
use EnricoDeLazzari\Wethod\Requests\Timesheet\UpdateTimesheet;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Timesheet extends BaseResource
{
    /**
     * @return array<int, TimesheetAreaDto>
     */
    public function listTimesheetAreas(?int $timesheetId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListTimesheetAreas($timesheetId, $limit, $offset, $updatedAt))->dto();
    }

    /**
     * @return array<int, TimesheetDto>
     */
    public function listTimesheets(?int $projectId = null, ?int $personId = null, ?string $date = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListTimesheets($projectId, $personId, $date, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createTimesheet(array $data = []): TimesheetDto
    {
        return $this->connector->send(new CreateTimesheet($data))->dto();
    }

    public function deleteTimesheet(int $id): Response
    {
        return $this->connector->send(new DeleteTimesheet($id));
    }

    public function updateTimesheet(int $id, array $data = []): TimesheetDto
    {
        return $this->connector->send(new UpdateTimesheet($id, $data))->dto();
    }
}
