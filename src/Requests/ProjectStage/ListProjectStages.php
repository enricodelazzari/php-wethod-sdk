<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectStage;

use EnricoDeLazzari\Wethod\Dto\ProjectStageDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project stages
 */
class ListProjectStages extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-stages';
    }

    public function __construct(
        protected ?string $order = null,
        protected ?string $search = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['order' => $this->order, 'search' => $this->search, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProjectStageDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectStageDto::collect($response->json());
    }
}
