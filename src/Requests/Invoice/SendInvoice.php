<?php

namespace EnricoDeLazzari\Wethod\Requests\Invoice;

use EnricoDeLazzari\Wethod\Dto\InvoiceDto;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Send an invoice
 */
class SendInvoice extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/api/invoices/{$this->id}:send";
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

    public function createDtoFromResponse(Response $response): InvoiceDto
    {
        return InvoiceDto::from($response->json());
    }
}
