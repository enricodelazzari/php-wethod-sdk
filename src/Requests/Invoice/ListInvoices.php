<?php

namespace EnricoDeLazzari\Wethod\Requests\Invoice;

use EnricoDeLazzari\Wethod\Dto\InvoiceDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List invoices
 */
class ListInvoices extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/invoices';
    }

    public function __construct(
        protected ?int $projectId = null,
        protected ?string $issueDate = null,
        protected ?string $paymentDate = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['project_id' => $this->projectId, 'issue_date' => $this->issueDate, 'payment_date' => $this->paymentDate, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, InvoiceDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return InvoiceDto::collect($response->json());
    }
}
