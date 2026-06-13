<?php

namespace EnricoDeLazzari\Wethod\Requests\Invoice;

use EnricoDeLazzari\Wethod\Dto\InvoiceContactDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List invoice contacts
 */
class ListInvoiceContacts extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/invoice-contacts';
    }

    public function __construct(
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, InvoiceContactDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return InvoiceContactDto::collect($response->json());
    }
}
