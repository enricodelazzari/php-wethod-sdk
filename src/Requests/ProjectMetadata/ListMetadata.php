<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectMetadata;

use EnricoDeLazzari\Wethod\Dto\MetadataDTO;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project metadata
 */
class ListMetadata extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-metadata';
    }

    public function __construct(
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, MetadataDTO>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return MetadataDTO::collect($response->json());
    }
}
