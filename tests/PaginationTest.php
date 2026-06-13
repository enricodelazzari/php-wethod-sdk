<?php

use EnricoDeLazzari\Wethod\Requests\Budget\ListBudgets;
use EnricoDeLazzari\Wethod\Wethod;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('iterates every page with the offset paginator', function () {
    $page1 = array_map(fn (int $i) => ['id' => $i], range(1, 100));
    $page2 = array_map(fn (int $i) => ['id' => $i], range(101, 150));

    $mock = new MockClient([
        MockResponse::make($page1, 200),
        MockResponse::make($page2, 200),
    ]);

    $wethod = (new Wethod('token', 'acme'))->withMockClient($mock);

    $ids = [];
    foreach ($wethod->paginate(new ListBudgets) as $response) {
        foreach ($response->json() as $row) {
            $ids[] = $row['id'];
        }
    }

    expect($ids)->toHaveCount(150)
        ->and($ids[0])->toBe(1)
        ->and($ids[149])->toBe(150)
        ->and($mock->getRecordedResponses())->toHaveCount(2);
});
