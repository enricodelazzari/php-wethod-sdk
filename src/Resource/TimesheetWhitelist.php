<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\TimesheetWhitelistDto;
use EnricoDeLazzari\Wethod\Requests\TimesheetWhitelist\GetTimesheetWhitelist;
use EnricoDeLazzari\Wethod\Requests\TimesheetWhitelist\ListTimesheetWhitelists;
use Saloon\Http\BaseResource;

class TimesheetWhitelist extends BaseResource
{
    /**
     * @return array<int, TimesheetWhitelistDto>
     */
    public function listTimesheetWhitelists(?int $projectId = null, ?int $personId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListTimesheetWhitelists($projectId, $personId, $limit, $offset, $updatedAt))->dto();
    }

    public function getTimesheetWhitelist(int $id): TimesheetWhitelistDto
    {
        return $this->connector->send(new GetTimesheetWhitelist($id))->dto();
    }
}
