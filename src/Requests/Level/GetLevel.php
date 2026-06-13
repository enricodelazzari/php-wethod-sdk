<?php

namespace EnricoDeLazzari\Wethod\Requests\Level;

use EnricoDeLazzari\Wethod\Dto\LevelDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a level
 */
class GetLevel extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/levels/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): LevelDto
    {
        return LevelDto::from($response->json());
    }
}
