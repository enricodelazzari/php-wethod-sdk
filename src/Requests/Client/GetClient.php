<?php

namespace EnricoDeLazzari\Wethod\Requests\Client;

use EnricoDeLazzari\Wethod\Dto\ClientDTO;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a client
 */
class GetClient extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/clients/{$this->id}";
    }

    public function __construct(
        protected int $id,
        protected ?string $include = null,
        protected ?string $deleted = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['include' => $this->include, 'deleted' => $this->deleted]);
    }

    public function createDtoFromResponse(Response $response): ClientDTO
    {
        return ClientDTO::from($response->json());
    }
}
