<?php

namespace EnricoDeLazzari\Wethod\Requests\Role;

use EnricoDeLazzari\Wethod\Dto\RoleDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List roles
 */
class ListRoles extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/roles';
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
     * @return array<int, RoleDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return RoleDto::collect($response->json());
    }
}
