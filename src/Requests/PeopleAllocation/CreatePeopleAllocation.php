<?php

namespace EnricoDeLazzari\Wethod\Requests\PeopleAllocation;

use EnricoDeLazzari\Wethod\Dto\PeopleAllocationDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a person allocation
 */
class CreatePeopleAllocation extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/people-allocations';
    }

    public function __construct(
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
