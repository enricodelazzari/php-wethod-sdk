<?php

namespace EnricoDeLazzari\Wethod\Exceptions;

/**
 * Thrown on a 429 response: the personal rate limit (5,000 requests/hour) was hit.
 */
class RateLimitException extends WethodRequestException
{
    /**
     * Seconds to wait before retrying, from the `x-ratelimit-retry-after` header.
     */
    public function retryAfter(): ?int
    {
        $value = $this->response()->header('x-ratelimit-retry-after');

        return $value !== null && $value !== '' ? (int) $value : null;
    }
}
