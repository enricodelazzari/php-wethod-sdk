<?php

namespace EnricoDeLazzari\Wethod\Requests\Person;

use EnricoDeLazzari\Wethod\Dto\EmployeeDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a person
 */
class UpdatePerson extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/persons/{$this->id}";
    }

    public function __construct(
        protected int $id,
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): EmployeeDto
    {
        return EmployeeDto::from($response->json());
    }
}
