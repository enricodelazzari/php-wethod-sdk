<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectType;

use EnricoDeLazzari\Wethod\Dto\ProjectLabelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List project types
 */
class ListProjectTypes extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/project-types';
    }

    public function __construct(
        protected ?string $order = null,
        protected ?string $search = null,
        protected ?string $group = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['order' => $this->order, 'search' => $this->search, 'group' => $this->group, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ProjectLabelDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectLabelDto::collect($response->json());
    }
}
