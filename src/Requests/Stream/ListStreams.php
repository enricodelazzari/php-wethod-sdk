<?php

namespace EnricoDeLazzari\Wethod\Requests\Stream;

use EnricoDeLazzari\Wethod\Dto\StreamDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List streams
 */
class ListStreams extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/streams';
    }

    public function __construct(
        protected ?string $isArchived = null,
        protected ?string $include = null,
        protected ?string $order = null,
        protected ?string $search = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['is_archived' => $this->isArchived, 'include' => $this->include, 'order' => $this->order, 'search' => $this->search, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, StreamDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return StreamDto::collect($response->json());
    }
}
