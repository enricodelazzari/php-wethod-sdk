<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\MetadataDTO;
use EnricoDeLazzari\Wethod\Requests\ProjectMetadata\CreateMetadata;
use EnricoDeLazzari\Wethod\Requests\ProjectMetadata\DeleteMetadata;
use EnricoDeLazzari\Wethod\Requests\ProjectMetadata\GetMetadata;
use EnricoDeLazzari\Wethod\Requests\ProjectMetadata\ListMetadata;
use EnricoDeLazzari\Wethod\Requests\ProjectMetadata\UpdateMetadata;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class ProjectMetadata extends BaseResource
{
    /**
     * @return array<int, MetadataDTO>
     */
    public function listMetadata(?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListMetadata($limit, $offset, $updatedAt))->dto();
    }

    public function createMetadata(array $data = []): MetadataDTO
    {
        return $this->connector->send(new CreateMetadata($data))->dto();
    }

    public function getMetadata(int $id): MetadataDTO
    {
        return $this->connector->send(new GetMetadata($id))->dto();
    }

    public function deleteMetadata(int $id): Response
    {
        return $this->connector->send(new DeleteMetadata($id));
    }

    public function updateMetadata(int $id, array $data = []): MetadataDTO
    {
        return $this->connector->send(new UpdateMetadata($id, $data))->dto();
    }
}
