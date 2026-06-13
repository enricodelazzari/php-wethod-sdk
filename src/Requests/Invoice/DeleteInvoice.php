<?php

namespace EnricoDeLazzari\Wethod\Requests\Invoice;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * Delete an invoice
 */
class DeleteInvoice extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/api/invoices/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

}
