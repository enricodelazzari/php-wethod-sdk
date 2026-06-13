<?php

namespace EnricoDeLazzari\Wethod\Requests\BusinessUnit;

use EnricoDeLazzari\Wethod\Dto\BusinessUnitDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List business units
 */
class ListBusinessUnits extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/business-units';
    }

    public function __construct(
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, BusinessUnitDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return BusinessUnitDto::collect($response->json());
    }
}
