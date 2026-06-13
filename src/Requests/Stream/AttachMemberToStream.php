<?php

namespace EnricoDeLazzari\Wethod\Requests\Stream;

use EnricoDeLazzari\Wethod\Dto\StreamMemberDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Attach member to stream
 */
class AttachMemberToStream extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/streams/{$this->streamId}/members/{$this->memberId}";
    }

    public function __construct(
        protected string $streamId,
        protected string $memberId,
    ) {}

    public function createDtoFromResponse(Response $response): StreamMemberDto
    {
        return StreamMemberDto::from($response->json());
    }
}
