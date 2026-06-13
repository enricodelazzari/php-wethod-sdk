<?php

namespace EnricoDeLazzari\Wethod\Requests\Client;

use EnricoDeLazzari\Wethod\Dto\ClientDTO;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List clients
 */
class ListClients extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/clients';
    }

    public function __construct(
        protected ?string $include = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['include' => $this->include, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, ClientDTO>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ClientDTO::collect($response->json());
    }
}
