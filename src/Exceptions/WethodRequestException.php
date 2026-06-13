<?php

namespace EnricoDeLazzari\Wethod\Exceptions;

use Saloon\Http\Response;
use Throwable;

/**
 * Thrown when the Wethod API returns an unsuccessful response.
 *
 * Use {@see self::fromResponse()} to build the most specific subclass for the
 * response status code.
 */
class WethodRequestException extends WethodException
{
    public function __construct(
        protected Response $response,
        string $message = '',
        ?Throwable $previous = null,
    ) {
        parent::__construct(
            $message !== '' ? $message : self::messageFor($response),
            $response->status(),
            $previous,
        );
    }

    /**
     * Map a failed response to the most specific exception type.
     */
    public static function fromResponse(Response $response, ?Throwable $senderException = null): self
    {
        return match ($response->status()) {
            400 => new ValidationException($response, previous: $senderException),
            401 => new UnauthorizedException($response, previous: $senderException),
            403 => new ForbiddenException($response, previous: $senderException),
            404 => new NotFoundException($response, previous: $senderException),
            412 => new PreconditionFailedException($response, previous: $senderException),
            429 => new RateLimitException($response, previous: $senderException),
            default => new self($response, previous: $senderException),
        };
    }

    public function response(): Response
    {
        return $this->response;
    }

    /**
     * The decoded JSON body of the error response, if any.
     *
     * @return array<string, mixed>
     */
    public function body(): array
    {
        return (array) $this->response->json();
    }

    private static function messageFor(Response $response): string
    {
        $body = $response->json();
        $message = is_array($body) ? ($body['message'] ?? $body['error'] ?? null) : null;

        return sprintf(
            'Wethod API request failed with status %d%s',
            $response->status(),
            is_string($message) && $message !== '' ? ": {$message}" : '',
        );
    }
}
