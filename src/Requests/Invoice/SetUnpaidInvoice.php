<?php

namespace EnricoDeLazzari\Wethod\Requests\Invoice;

use EnricoDeLazzari\Wethod\Dto\InvoiceDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Set an invoice as unpaid
 */
class SetUnpaidInvoice extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/invoices/{$this->id}:set-unpaid";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): InvoiceDto
    {
        return InvoiceDto::from($response->json());
    }
}
