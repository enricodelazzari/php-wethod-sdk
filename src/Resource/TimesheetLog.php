<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\TimesheetLogDto;
use EnricoDeLazzari\Wethod\Requests\TimesheetLog\GetTimesheetLog;
use EnricoDeLazzari\Wethod\Requests\TimesheetLog\ListTimesheetLogs;
use Saloon\Http\BaseResource;

class TimesheetLog extends BaseResource
{
    /**
     * @return array<int, TimesheetLogDto>
     */
    public function listTimesheetLogs(?int $personId = null, ?string $date = null, ?int $projectId = null, ?int $toProjectId = null, ?string $mode = null, ?string $order = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListTimesheetLogs($personId, $date, $projectId, $toProjectId, $mode, $order, $limit, $offset, $updatedAt))->dto();
    }

    public function getTimesheetLog(int $id): TimesheetLogDto
    {
        return $this->connector->send(new GetTimesheetLog($id))->dto();
    }
}
