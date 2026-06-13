<?php

namespace EnricoDeLazzari\Wethod\Requests\Client;

use EnricoDeLazzari\Wethod\Dto\ClientDTO;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Create a client
 */
class CreateClient extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/api/client';
    }

    public function __construct(
        /** @var array<string, mixed> */
        protected array $data = [],
    ) {}

    public function defaultBody(): array
    {
        return $this->data;
    }

    public function createDtoFromResponse(Response $response): ClientDTO
    {
        return ClientDTO::from($response->json());
    }
}
