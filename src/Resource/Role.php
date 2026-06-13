<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\RoleDto;
use EnricoDeLazzari\Wethod\Requests\Role\GetRole;
use EnricoDeLazzari\Wethod\Requests\Role\ListRoles;
use Saloon\Http\BaseResource;

class Role extends BaseResource
{
    /**
     * @return array<int, RoleDto>
     */
    public function listRoles(?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListRoles($limit, $offset, $updatedAt))->dto();
    }

    public function getRole(int $id): RoleDto
    {
        return $this->connector->send(new GetRole($id))->dto();
    }
}
