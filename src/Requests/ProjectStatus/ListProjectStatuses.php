<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectStatus;

use EnricoDeLazzari\Wethod\Dto\ProjectStatusDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project statuses
 */
class ListProjectStatuses extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-statuses';
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
     * @return array<int, ProjectStatusDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectStatusDto::collect($response->json());
    }
}
