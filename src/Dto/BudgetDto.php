<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class BudgetDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $projectId = null,
        public ?int $priceListId = null,
        public ?int $streamId = null,
        public ?int $version = null,
        public ?string $status = null,
        public ?float $finalNetPrice = null,
        public ?float $finalNetPriceCurrency = null,
        public ?float $totalExternalCost = null,
        public ?float $totalCost = null,
        public ?float $totalPrice = null,
        public ?float $totalDays = null,
        public ?bool $isBaseline = null,
        public ?string $notes = null,
        public ?string $currency = null,
        public ?bool $isCurrencyEnabled = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            projectId: $data['project_id'] ?? null,
            priceListId: $data['price_list_id'] ?? null,
            streamId: $data['stream_id'] ?? null,
            version: $data['version'] ?? null,
            status: $data['status'] ?? null,
            finalNetPrice: $data['final_net_price'] ?? null,
            finalNetPriceCurrency: $data['final_net_price_currency'] ?? null,
            totalExternalCost: $data['total_external_cost'] ?? null,
            totalCost: $data['total_cost'] ?? null,
            totalPrice: $data['total_price'] ?? null,
            totalDays: $data['total_days'] ?? null,
            isBaseline: $data['is_baseline'] ?? null,
            notes: $data['notes'] ?? null,
            currency: $data['currency'] ?? null,
            isCurrencyEnabled: $data['is_currency_enabled'] ?? null,
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
