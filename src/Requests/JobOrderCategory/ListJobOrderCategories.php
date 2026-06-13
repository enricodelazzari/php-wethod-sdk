<?php

namespace EnricoDeLazzari\Wethod\Requests\JobOrderCategory;

use EnricoDeLazzari\Wethod\Dto\ProjectTypeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List job order categories
 */
class ListJobOrderCategories extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/job-order-categories';
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
     * @return array<int, ProjectTypeDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ProjectTypeDto::collect($response->json());
    }
}
