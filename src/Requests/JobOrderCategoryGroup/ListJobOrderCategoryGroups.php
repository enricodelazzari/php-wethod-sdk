<?php

namespace EnricoDeLazzari\Wethod\Requests\JobOrderCategoryGroup;

use EnricoDeLazzari\Wethod\Dto\ProjectTypeGroupDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List job order category groups
 */
class ListJobOrderCategoryGroups extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/job-order-category-groups';
    }

    public function __construct(
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, ProjectTypeGroupDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectTypeGroupDto::collect($response->json());
    }
}
