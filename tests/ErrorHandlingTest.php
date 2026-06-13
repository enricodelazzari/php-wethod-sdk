<?php

use EnricoDeLazzari\Wethod\Exceptions\ForbiddenException;
use EnricoDeLazzari\Wethod\Exceptions\NotFoundException;
use EnricoDeLazzari\Wethod\Exceptions\PreconditionFailedException;
use EnricoDeLazzari\Wethod\Exceptions\RateLimitException;
use EnricoDeLazzari\Wethod\Exceptions\UnauthorizedException;
use EnricoDeLazzari\Wethod\Exceptions\ValidationException;
use EnricoDeLazzari\Wethod\Wethod;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('maps error responses to typed exceptions', function (int $status, string $expected) {
    $mock = new MockClient([
        MockResponse::make(['message' => 'error'], $status),
    ]);

    $wethod = (new Wethod('token', 'acme'))->withMockClient($mock);

    expect(fn () => $wethod->budget()->getBudget(1))->toThrow($expected);
})->with([
    'validation' => [400, ValidationException::class],
    'unauthorized' => [401, UnauthorizedException::class],
    'forbidden' => [403, ForbiddenException::class],
    'not found' => [404, NotFoundException::class],
    'precondition' => [412, PreconditionFailedException::class],
    'rate limit' => [429, RateLimitException::class],
]);

it('exposes field errors on a validation exception', function () {
    $mock = new MockClient([
        MockResponse::make(['errors' => ['project_id' => 'required']], 400),
    ]);

    $wethod = (new Wethod('token', 'acme'))->withMockClient($mock);

    try {
        $wethod->budget()->createBudget([]);
        $this->fail('Expected a ValidationException to be thrown.');
    } catch (ValidationException $e) {
        expect($e->errors())->toBe(['project_id' => 'required'])
            ->and($e->getCode())->toBe(400);
    }
});

it('exposes the retry-after delay on a rate limit exception', function () {
    $mock = new MockClient([
        MockResponse::make(['message' => 'slow down'], 429, ['x-ratelimit-retry-after' => '42']),
    ]);

    $wethod = (new Wethod('token', 'acme'))->withMockClient($mock);

    try {
        $wethod->budget()->getBudget(1);
        $this->fail('Expected a RateLimitException to be thrown.');
    } catch (RateLimitException $e) {
        expect($e->retryAfter())->toBe(42)
            ->and($e->getCode())->toBe(429);
    }
});
