<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\PriceListDto;
use EnricoDeLazzari\Wethod\Requests\PriceList\CreatePriceList;
use EnricoDeLazzari\Wethod\Requests\PriceList\GetPriceList;
use EnricoDeLazzari\Wethod\Requests\PriceList\ListPriceLists;
use EnricoDeLazzari\Wethod\Requests\PriceList\UpdatePriceList;
use Saloon\Http\BaseResource;

class PriceList extends BaseResource
{
    /**
     * @return array<int, PriceListDto>
     */
    public function listPriceLists(?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListPriceLists($limit, $offset, $updatedAt))->dto();
    }

    public function createPriceList(array $data = []): PriceListDto
    {
        return $this->connector->send(new CreatePriceList($data))->dto();
    }

    public function getPriceList(int $id): PriceListDto
    {
        return $this->connector->send(new GetPriceList($id))->dto();
    }

    public function updatePriceList(int $id, array $data = []): PriceListDto
    {
        return $this->connector->send(new UpdatePriceList($id, $data))->dto();
    }
}
