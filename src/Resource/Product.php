<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ProductDto;
use EnricoDeLazzari\Wethod\Requests\Product\CreateProduct;
use EnricoDeLazzari\Wethod\Requests\Product\GetProduct;
use EnricoDeLazzari\Wethod\Requests\Product\ListProducts;
use EnricoDeLazzari\Wethod\Requests\Product\UpdateProduct;
use Saloon\Http\BaseResource;

class Product extends BaseResource
{
    /**
     * @return array<int, ProductDto>
     */
    public function listProducts(?string $availableFrom = null, ?string $availableTo = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListProducts($availableFrom, $availableTo, $limit, $offset, $updatedAt))->dto();
    }

    public function createProduct(array $data = []): ProductDto
    {
        return $this->connector->send(new CreateProduct($data))->dto();
    }

    public function getProduct(int $id): ProductDto
    {
        return $this->connector->send(new GetProduct($id))->dto();
    }

    public function updateProduct(int $id, array $data = []): ProductDto
    {
        return $this->connector->send(new UpdateProduct($id, $data))->dto();
    }
}
