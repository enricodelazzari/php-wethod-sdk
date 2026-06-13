<?php

namespace EnricoDeLazzari\Wethod\Exceptions;

/**
 * Thrown on a 400 response: the request payload failed validation.
 */
class ValidationException extends WethodRequestException
{
    /**
     * The field-level validation errors returned by the API, if any.
     *
     * @return array<string, mixed>
     */
    public function errors(): array
    {
        $body = $this->response()->json();

        return is_array($body) ? (array) ($body['errors'] ?? $body['violations'] ?? []) : [];
    }
}
