# Wethod PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/enricodelazzari/php-wethod-sdk.svg?style=flat-square)](https://packagist.org/packages/enricodelazzari/php-wethod-sdk)
[![Tests](https://github.com/enricodelazzari/php-wethod-sdk/actions/workflows/run-tests.yml/badge.svg)](https://github.com/enricodelazzari/php-wethod-sdk/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/enricodelazzari/php-wethod-sdk.svg?style=flat-square)](https://packagist.org/packages/enricodelazzari/php-wethod-sdk)

A framework-agnostic PHP SDK for the [Wethod REST API](https://docs.wethod.com/getting-started),
built on [Saloon v4](https://docs.saloon.dev). It covers the full API surface (~50 resources) with
typed, readonly DTOs, an offset paginator, a filter helper and typed exceptions.

## Installation

```bash
composer require enricodelazzari/php-wethod-sdk
```

Requires PHP 8.4+.

## Getting started

Create a personal API token from your Wethod account settings, then instantiate the client with the
token and your company endpoint slug (the `acme` in `https://acme.wethod.com`):

```php
use EnricoDeLazzari\Wethod\Wethod;

$wethod = new Wethod(
    token: 'your-api-token',
    company: 'acme',
    apiVersion: '2024-06-15', // optional, this is the default
);
```

The client automatically sends the `Authorization: Bearer …`, `Wethod-Company` and `Wethod-Version`
headers on every request.

## Usage

Every API resource is available as a method on the client and returns typed DTOs:

```php
// List (returns BudgetDto[])
$budgets = $wethod->budget()->listBudgets(projectId: 12);

foreach ($budgets as $budget) {
    echo $budget->id, ' ', $budget->status, PHP_EOL; // typed properties
}

// Get one (returns BudgetDto)
$budget = $wethod->budget()->getBudget(5);

// Create / update send a JSON body and return the resulting DTO
$budget = $wethod->budget()->createBudget(['project_id' => 12, 'price_list_id' => 2]);
$budget = $wethod->budget()->updateBudget(5, ['notes' => 'Updated estimate']);

// Action endpoints (POST /api/budgets/{id}:approve)
$wethod->budget()->approveBudget(5);

// The authenticated user
$me = $wethod->person()->getAuthenticatedPerson();
```

Method and DTO names mirror the API's `operationId`s, so `listBudgets`, `getBudget`,
`approveBudget`, etc. The resource accessors are `budget()`, `project()`, `client()`, `person()`,
`timesheet()`, `invoice()`, `peopleAllocation()` … one per API resource.

### Filtering

List endpoints accept filterable fields using operator-prefixed values. The `Filter` helper builds
them for you:

```php
use EnricoDeLazzari\Wethod\Filter;

$wethod->budget()->listBudgets(
    updatedAt: Filter::gte(new DateTimeImmutable('-7 days')),
);

Filter::eq(5);            // "eq:5"
Filter::in([1, 2, 3]);    // "in:1,2,3"
Filter::between(0, 100);  // "bt:0,100"
```

Supported operators: `eq`, `notEq`, `gt`, `gte`, `lt`, `lte`, `in`, `notIn`, `between`.

### Pagination

List endpoints are paginated with `offset`/`limit` (max 100 per page). Pass them directly for manual
control, or iterate every page with the built-in offset paginator:

```php
use EnricoDeLazzari\Wethod\Requests\Budget\ListBudgets;

// One page
$wethod->budget()->listBudgets(projectId: 12, limit: 50, offset: 100);

// Every page, lazily
foreach ($wethod->paginate(new ListBudgets(projectId: 12)) as $response) {
    foreach ($response->json() as $row) {
        // ...
    }
}
```

### Error handling

Unsuccessful responses throw a typed exception extending `WethodRequestException`:

| Status | Exception                     |
|--------|-------------------------------|
| 400    | `ValidationException`         |
| 401    | `UnauthorizedException`       |
| 403    | `ForbiddenException`          |
| 404    | `NotFoundException`           |
| 412    | `PreconditionFailedException` |
| 429    | `RateLimitException`          |
| other  | `WethodRequestException`      |

```php
use EnricoDeLazzari\Wethod\Exceptions\RateLimitException;
use EnricoDeLazzari\Wethod\Exceptions\ValidationException;

try {
    $wethod->budget()->createBudget([]);
} catch (ValidationException $e) {
    $e->errors();   // field-level validation errors
} catch (RateLimitException $e) {
    $e->retryAfter(); // seconds, from x-ratelimit-retry-after
}
```

Every exception exposes the underlying `$e->response()` (a Saloon `Response`). The personal rate limit
is 5,000 requests per hour.

## Testing

```bash
composer test
```

## Regenerating the SDK

The request, resource, connector and DTO classes are generated from the vendored OpenAPI spec
(`resources/openapi.yaml`) by `tools/build-sdk.php`. After updating the spec, regenerate with:

```bash
composer generate
```

This re-scaffolds the SDK and formats it with Pint. Hand edits to generated files under
`src/Requests`, `src/Resource`, `src/Dto` and `src/Wethod.php` will be overwritten; cross-cutting code
(exceptions, paginator, filter helper) lives in separate, hand-written files.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Enrico De Lazzari](https://github.com/enricodelazzari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
