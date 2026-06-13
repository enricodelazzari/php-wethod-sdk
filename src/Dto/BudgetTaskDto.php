<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class BudgetTaskDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $uid = null,
        public ?string $name = null,
        public ?string $currency = null,
        public ?float $externalCost = null,
        public ?int $markup = null,
        public ?float $totalCost = null,
        public ?float $totalPrice = null,
        public ?float $totalDays = null,
        public ?string $type = null,
        public ?bool $isDeleted = null,
        public ?string $notes = null,
        public ?int $productId = null,
        public ?int $quantity = null,
        public ?int $budgetAreaId = null,
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
            uid: $data['uid'] ?? null,
            name: $data['name'] ?? null,
            currency: $data['currency'] ?? null,
            externalCost: $data['external_cost'] ?? null,
            markup: $data['markup'] ?? null,
            totalCost: $data['total_cost'] ?? null,
            totalPrice: $data['total_price'] ?? null,
            totalDays: $data['total_days'] ?? null,
            type: $data['type'] ?? null,
            isDeleted: $data['is_deleted'] ?? null,
            notes: $data['notes'] ?? null,
            productId: $data['product_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            budgetAreaId: $data['budget_area_id'] ?? null,
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
