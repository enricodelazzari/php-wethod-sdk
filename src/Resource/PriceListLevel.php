<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\PriceListLevelDto;
use EnricoDeLazzari\Wethod\Requests\PriceListLevel\GetPriceListLevel;
use EnricoDeLazzari\Wethod\Requests\PriceListLevel\ListPriceListLevels;
use EnricoDeLazzari\Wethod\Requests\PriceListLevel\UpdatePriceListLevel;
use Saloon\Http\BaseResource;

class PriceListLevel extends BaseResource
{
    /**
     * @return array<int, PriceListLevelDto>
     */
    public function listPriceListLevels(?int $priceListId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListPriceListLevels($priceListId, $limit, $offset, $updatedAt))->dto();
    }

    public function getPriceListLevel(int $id): PriceListLevelDto
    {
        return $this->connector->send(new GetPriceListLevel($id))->dto();
    }

    public function updatePriceListLevel(int $id, array $data = []): PriceListLevelDto
    {
        return $this->connector->send(new UpdatePriceListLevel($id, $data))->dto();
    }
}
