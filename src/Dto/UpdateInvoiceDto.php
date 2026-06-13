<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateInvoiceDto
{
    public function __construct(
        public ?string $invoiceNumber = null,
        public ?string $purchaseOrder = null,
        public ?float $value = null,
        public ?float $exchangeRate = null,
        public mixed $issueDate = null,
        public ?string $notes = null,
        public ?int $projectId = null,
        public ?string $budgetAreaUid = null,
        public ?int $vatRateId = null,
        public ?int $paymentTermId = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            invoiceNumber: $data['invoice_number'] ?? null,
            purchaseOrder: $data['purchase_order'] ?? null,
            value: $data['value'] ?? null,
            exchangeRate: $data['exchange_rate'] ?? null,
            issueDate: $data['issue_date'] ?? null,
            notes: $data['notes'] ?? null,
            projectId: $data['project_id'] ?? null,
            budgetAreaUid: $data['budget_area_uid'] ?? null,
            vatRateId: $data['vat_rate_id'] ?? null,
            paymentTermId: $data['payment_term_id'] ?? null,
        );
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return array<int, self>
     */
    public static function collect(array $items): array
    {
        return array_map(static fn (array $item): self => self::from($item), $items);
    }
}
