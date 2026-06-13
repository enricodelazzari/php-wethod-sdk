<?php

namespace EnricoDeLazzari\Wethod\Requests\Stream;

use EnricoDeLazzari\Wethod\Dto\StreamDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Unarchive a stream
 */
class UnarchiveStream extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/streams/{$this->id}:unarchive";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): StreamDto
    {
        return StreamDto::from($response->json());
    }
}
