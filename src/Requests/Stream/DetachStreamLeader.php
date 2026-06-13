<?php

namespace EnricoDeLazzari\Wethod\Requests\Stream;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Detach leader from stream
 */
class DetachStreamLeader extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/streams/{$this->streamId}/leaders/{$this->leaderId}";
    }

    public function __construct(
        protected string $streamId,
        protected string $leaderId,
    ) {}

}
