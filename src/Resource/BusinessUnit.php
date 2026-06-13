<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\BusinessUnitDto;
use EnricoDeLazzari\Wethod\Requests\BusinessUnit\GetBusinessUnit;
use EnricoDeLazzari\Wethod\Requests\BusinessUnit\ListBusinessUnits;
use Saloon\Http\BaseResource;

class BusinessUnit extends BaseResource
{
    /**
     * @return array<int, BusinessUnitDto>
     */
    public function listBusinessUnits(?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListBusinessUnits($limit, $offset, $updatedAt))->dto();
    }

    public function getBusinessUnit(int $id): BusinessUnitDto
    {
        return $this->connector->send(new GetBusinessUnit($id))->dto();
    }
}
