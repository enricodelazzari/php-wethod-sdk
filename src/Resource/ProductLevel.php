<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProductLevelDto;
use EnricoDeLazzari\Wethod\Requests\ProductLevel\GetProductLevel;
use EnricoDeLazzari\Wethod\Requests\ProductLevel\ListProductLevels;
use EnricoDeLazzari\Wethod\Requests\ProductLevel\UpdateProductLevel;
use Saloon\Http\BaseResource;

class ProductLevel extends BaseResource
{
    /**
     * @return array<int, ProductLevelDto>
     */
    public function listProductLevels(?int $productId = null, ?int $levelId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProductLevels($productId, $levelId, $limit, $offset, $updatedAt))->dto();
    }

    public function getProductLevel(int $id): ProductLevelDto
    {
        return $this->connector->send(new GetProductLevel($id))->dto();
    }

    public function updateProductLevel(int $id, array $data = []): ProductLevelDto
    {
        return $this->connector->send(new UpdateProductLevel($id, $data))->dto();
    }
}
