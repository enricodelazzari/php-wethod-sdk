<?php

use EnricoDeLazzari\Wethod\Dto\BudgetDto;
use EnricoDeLazzari\Wethod\Wethod;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

function wethod(MockClient $mock): Wethod
{
    return (new Wethod('token', 'acme'))->withMockClient($mock);
}

it('lists budgets as typed DTOs and forwards filters as query params', function () {
    $mock = new MockClient([
        MockResponse::make([
            ['id' => 1, 'project_id' => 10, 'status' => 'DRAFT'],
            ['id' => 2, 'project_id' => 10, 'status' => 'APPROVED'],
        ], 200),
    ]);

    $budgets = wethod($mock)->budget()->listBudgets(projectId: 10);

    expect($budgets)->toHaveCount(2)
        ->and($budgets[0])->toBeInstanceOf(BudgetDto::class)
        ->and($budgets[0]->id)->toBe(1)
        ->and($budgets[0]->projectId)->toBe(10)
        ->and($budgets[1]->status)->toBe('APPROVED')
        ->and($mock->getLastPendingRequest()->query()->get('project_id'))->toBe(10);
});

it('gets a single budget as a DTO', function () {
    $mock = new MockClient([
        MockResponse::make(['id' => 5, 'project_id' => 10, 'is_baseline' => true], 200),
    ]);

    $budget = wethod($mock)->budget()->getBudget(5);

    expect($budget)->toBeInstanceOf(BudgetDto::class)
        ->and($budget->id)->toBe(5)
        ->and($budget->isBaseline)->toBeTrue();
});

it('creates a budget sending a JSON body', function () {
    $mock = new MockClient([
        MockResponse::make(['id' => 9, 'status' => 'DRAFT'], 201),
    ]);

    $budget = wethod($mock)->budget()->createBudget(['project_id' => 10, 'price_list_id' => 2]);

    expect($budget)->toBeInstanceOf(BudgetDto::class)
        ->and($budget->id)->toBe(9)
        ->and($mock->getLastPendingRequest()->body()->all())->toBe(['project_id' => 10, 'price_list_id' => 2]);
});

it('approves a budget using the :approve action endpoint', function () {
    $mock = new MockClient([
        MockResponse::make(['id' => 5, 'status' => 'APPROVED'], 200),
    ]);

    $budget = wethod($mock)->budget()->approveBudget(5);

    expect($budget->status)->toBe('APPROVED')
        ->and($mock->getLastPendingRequest()->getUrl())->toBe('https://api.wethod.com/api/budgets/5:approve');
});
