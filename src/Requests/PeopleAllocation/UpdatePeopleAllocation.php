<?php

namespace EnricoDeLazzari\Wethod\Requests\PeopleAllocation;

use EnricoDeLazzari\Wethod\Dto\PeopleAllocationDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Update a person allocation
 */
class UpdatePeopleAllocation extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/api/people-allocations/{$this->id}";
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

    public function createDtoFromResponse(Response $response): PeopleAllocationDto
    {
        return PeopleAllocationDto::from($response->json());
    }
}
