<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectPlanArea;

use EnricoDeLazzari\Wethod\Dto\ProjectPlanAreaDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project plan areas
 */
class ListProjectPlanAreas extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-plan-areas';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProjectPlanAreaDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectPlanAreaDto::collect($response->json());
    }
}
