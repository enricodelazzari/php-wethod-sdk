<?php

namespace EnricoDeLazzari\Wethod\Requests\Invoice;

use EnricoDeLazzari\Wethod\Dto\InvoiceContactDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get an invoice contact
 */
class GetInvoiceContact extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/invoice-contacts/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): InvoiceContactDto
    {
        return InvoiceContactDto::from($response->json());
    }
}
