<?php

namespace EnricoDeLazzari\Wethod\Requests\Invoice;

use EnricoDeLazzari\Wethod\Dto\InvoiceDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get an invoice
 */
class GetInvoice extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/invoices/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): InvoiceDto
    {
        return InvoiceDto::from($response->json());
    }
}
