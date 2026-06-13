<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class BudgetAreaDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?bool $isEnabled = null,
        public ?string $type = null,
        public ?float $totalExternalCost = null,
        public ?float $totalCost = null,
        public ?float $totalPrice = null,
        public ?float $totalDays = null,
        public ?int $budgetId = null,
        public ?int $priceListId = null,
        public ?int $streamId = null,
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
            name: $data['name'] ?? null,
            isEnabled: $data['is_enabled'] ?? null,
            type: $data['type'] ?? null,
            totalExternalCost: $data['total_external_cost'] ?? null,
            totalCost: $data['total_cost'] ?? null,
            totalPrice: $data['total_price'] ?? null,
            totalDays: $data['total_days'] ?? null,
            budgetId: $data['budget_id'] ?? null,
            priceListId: $data['price_list_id'] ?? null,
            streamId: $data['stream_id'] ?? null,
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
