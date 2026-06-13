<?php

namespace EnricoDeLazzari\Wethod\Requests\Project;

use EnricoDeLazzari\Wethod\Dto\ProjectDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List projects
 */
class ListProjects extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/projects';
    }

    public function __construct(
        protected ?int $probability = null,
        protected ?int $projectStageId = null,
        protected ?string $dateStart = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['probability' => $this->probability, 'project_stage_id' => $this->projectStageId, 'date_start' => $this->dateStart, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, ProjectDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectDto::collect($response->json());
    }
}
