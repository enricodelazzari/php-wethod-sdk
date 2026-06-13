<?php

use EnricoDeLazzari\Wethod\Filter;

it('builds operator-prefixed filter values', function () {
    expect(Filter::eq(5))->toBe('eq:5')
        ->and(Filter::notEq(5))->toBe('neq:5')
        ->and(Filter::gt(1))->toBe('gt:1')
        ->and(Filter::gte('2024-01-01'))->toBe('gte:2024-01-01')
        ->and(Filter::lt(9))->toBe('lt:9')
        ->and(Filter::lte(9))->toBe('lte:9')
        ->and(Filter::in([1, 2, 3]))->toBe('in:1,2,3')
        ->and(Filter::notIn(['a', 'b']))->toBe('nin:a,b')
        ->and(Filter::between(0, 100))->toBe('bt:0,100');
});

it('formats booleans and dates', function () {
    expect(Filter::eq(true))->toBe('eq:true')
        ->and(Filter::eq(false))->toBe('eq:false')
        ->and(Filter::gt(new DateTimeImmutable('2024-06-15T10:00:00+00:00')))->toBe('gt:2024-06-15T10:00:00+00:00');
});
