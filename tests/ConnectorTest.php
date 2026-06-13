<?php

use EnricoDeLazzari\Wethod\Wethod;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('sends the bearer token and the required Wethod headers', function () {
    $mock = new MockClient([
        MockResponse::make(['id' => 5], 200),
    ]);

    $wethod = (new Wethod('secret-token', 'acme'))->withMockClient($mock);
    $wethod->budget()->getBudget(5);

    $pending = $mock->getLastPendingRequest();
    $headers = $pending->headers()->all();

    expect($headers['Authorization'])->toBe('Bearer secret-token')
        ->and($headers['Wethod-Company'])->toBe('acme')
        ->and($headers['Wethod-Version'])->toBe('2024-06-15')
        ->and($headers['Accept'])->toBe('application/json')
        ->and($pending->getUrl())->toBe('https://api.wethod.com/api/budgets/5');
});

it('allows overriding the API version', function () {
    $mock = new MockClient([
        MockResponse::make(['id' => 5], 200),
    ]);

    $wethod = (new Wethod('t', 'acme', '2025-01-01'))->withMockClient($mock);
    $wethod->budget()->getBudget(5);

    expect($mock->getLastPendingRequest()->headers()->get('Wethod-Version'))->toBe('2025-01-01');
});
