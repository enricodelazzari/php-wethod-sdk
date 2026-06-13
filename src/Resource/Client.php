<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ClientDTO;
use EnricoDeLazzari\Wethod\Requests\Client\CreateClient;
use EnricoDeLazzari\Wethod\Requests\Client\DeleteClient;
use EnricoDeLazzari\Wethod\Requests\Client\GetClient;
use EnricoDeLazzari\Wethod\Requests\Client\ListClients;
use EnricoDeLazzari\Wethod\Requests\Client\UpdateClient;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Client extends BaseResource
{
    /**
     * @return array<int, ClientDTO>
     */
    public function listClients(?string $include = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListClients($include, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function getClient(int $id, ?string $include = null, ?string $deleted = null): ClientDTO
    {
        return $this->connector->send(new GetClient($id, $include, $deleted))->dto();
    }

    public function createClient(array $data = []): ClientDTO
    {
        return $this->connector->send(new CreateClient($data))->dto();
    }

    public function deleteClient(int $id): Response
    {
        return $this->connector->send(new DeleteClient($id));
    }

    public function updateClient(int $id, array $data = []): ClientDTO
    {
        return $this->connector->send(new UpdateClient($id, $data))->dto();
    }
}
