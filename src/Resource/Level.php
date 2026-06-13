<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\LevelDto;
use EnricoDeLazzari\Wethod\Requests\Level\GetLevel;
use EnricoDeLazzari\Wethod\Requests\Level\ListLevels;
use Saloon\Http\BaseResource;

class Level extends BaseResource
{
    /**
     * @return array<int, LevelDto>
     */
    public function listLevels(?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListLevels($limit, $offset, $updatedAt))->dto();
    }

    public function getLevel(int $id): LevelDto
    {
        return $this->connector->send(new GetLevel($id))->dto();
    }
}
