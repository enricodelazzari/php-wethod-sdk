<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductionPlanStream;

use EnricoDeLazzari\Wethod\Dto\ProductionPlanStreamDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List production plan streams
 */
class ListProductionPlanStreams extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/production-plan-streams';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $streamId = null,
        protected ?int $productionPlanId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'stream_id' => $this->streamId, 'production_plan_id' => $this->productionPlanId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, ProductionPlanStreamDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProductionPlanStreamDto::collect($response->json());
    }
}
