<?php

namespace EnricoDeLazzari\Wethod\Requests\Stream;

use EnricoDeLazzari\Wethod\Dto\StreamLeaderDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List stream leaders
 */
class ListStreamLeaders extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/streams/{$this->streamId}/leaders";
    }

    public function __construct(
        protected string $streamId,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, StreamLeaderDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return StreamLeaderDto::collect($response->json());
    }
}
