<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomField;

use EnricoDeLazzari\Wethod\Dto\CustomFieldDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List custom fields
 */
class ListCustomFields extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/custom-fields';
    }

    public function __construct(
        protected ?string $domain = null,
        protected ?string $include = null,
        protected ?string $order = null,
        protected ?string $search = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
        protected ?string $archived = null,
        protected ?string $archivedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['domain' => $this->domain, 'include' => $this->include, 'order' => $this->order, 'search' => $this->search, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt, 'archived' => $this->archived, 'archived_at' => $this->archivedAt]);
    }

    /**
     * @return array<int, CustomFieldDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return CustomFieldDto::collect($response->json());
    }
}
