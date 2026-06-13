<?php

namespace EnricoDeLazzari\Wethod\Requests\Stream;

use EnricoDeLazzari\Wethod\Dto\StreamMemberDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List stream members
 */
class ListStreamMembers extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/streams/{$this->streamId}/members";
    }

    public function __construct(
        protected string $streamId,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, StreamMemberDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return StreamMemberDto::collect($response->json());
    }
}
