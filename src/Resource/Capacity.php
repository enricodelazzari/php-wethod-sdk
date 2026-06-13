<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\WorkHourCapacityDto;
use EnricoDeLazzari\Wethod\Requests\Capacity\GetCapacity;
use EnricoDeLazzari\Wethod\Requests\Capacity\ListCapacities;
use Saloon\Http\BaseResource;

class Capacity extends BaseResource
{
    /**
     * @return array<int, WorkHourCapacityDto>
     */
    public function listCapacities(?string $order = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $isArchived = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListCapacities($order, $limit, $offset, $updatedAt, $isArchived, $deleted, $deletedAt))->dto();
    }

    public function getCapacity(int $id): WorkHourCapacityDto
    {
        return $this->connector->send(new GetCapacity($id))->dto();
    }
}
