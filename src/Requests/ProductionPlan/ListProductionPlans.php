<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductionPlan;

use EnricoDeLazzari\Wethod\Dto\ProductionPlanDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List production plans
 */
class ListProductionPlans extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/production-plans';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, ProductionPlanDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProductionPlanDto::collect($response->json());
    }
}
