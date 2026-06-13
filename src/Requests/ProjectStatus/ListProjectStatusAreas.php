<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectStatus;

use EnricoDeLazzari\Wethod\Dto\ProjectStatusAreaDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project status areas
 */
class ListProjectStatusAreas extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-status-areas';
    }

    public function __construct(
        protected ?int $projectStatusId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_status_id' => $this->projectStatusId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, ProjectStatusAreaDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectStatusAreaDto::collect($response->json());
    }
}
