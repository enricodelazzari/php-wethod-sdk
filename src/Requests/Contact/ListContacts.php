<?php

namespace EnricoDeLazzari\Wethod\Requests\Contact;

use EnricoDeLazzari\Wethod\Dto\ContactDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List contacts
 */
class ListContacts extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/contacts';
    }

    public function __construct(
        protected ?int $clientId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['client_id' => $this->clientId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, ContactDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return ContactDto::collect($response->json());
    }
}
