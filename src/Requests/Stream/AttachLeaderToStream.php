<?php

namespace EnricoDeLazzari\Wethod\Requests\Stream;

use EnricoDeLazzari\Wethod\Dto\StreamLeaderDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Attach leader to stream
 */
class AttachLeaderToStream extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/streams/{$this->streamId}/leaders/{$this->leaderId}";
    }

    public function __construct(
        protected string $streamId,
        protected string $leaderId,
    ) {}

    public function createDtoFromResponse(Response $response): StreamLeaderDto
    {
        return StreamLeaderDto::from($response->json());
    }
}
