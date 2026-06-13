<?php

namespace EnricoDeLazzari\Wethod\Requests\Role;

use EnricoDeLazzari\Wethod\Dto\RoleDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a role
 */
class GetRole extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/roles/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): RoleDto
    {
        return RoleDto::from($response->json());
    }
}
