<?php

namespace EnricoDeLazzari\Wethod\Requests\CustomFieldOption;

use EnricoDeLazzari\Wethod\Dto\CustomFieldOptionDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List custom field options
 */
class ListCustomFieldOptions extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/custom-field-options';
    }

    public function __construct(
        protected ?int $customFieldId = null,
        protected ?string $order = null,
        protected ?string $search = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
        protected ?string $deleted = null,
        protected ?string $deletedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['custom_field_id' => $this->customFieldId, 'order' => $this->order, 'search' => $this->search, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt, 'deleted' => $this->deleted, 'deleted_at' => $this->deletedAt]);
    }

    /**
     * @return array<int, CustomFieldOptionDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return CustomFieldOptionDto::collect($response->json());
    }
}
