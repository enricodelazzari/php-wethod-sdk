<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductionStream;

use EnricoDeLazzari\Wethod\Dto\ProductionStreamDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List production streams
 */
class ListProductionStreams extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/production-streams';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $productionId = null,
        protected ?int $streamId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'production_id' => $this->productionId, 'stream_id' => $this->streamId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, ProductionStreamDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProductionStreamDto::collect($response->json());
    }
}
