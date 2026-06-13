<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateBudgetTaskDto
{
    public function __construct(
        public ?string $name = null,
        public mixed $externalCost = null,
        public ?int $markup = null,
        public ?string $notes = null,
        public ?int $quantity = null,
        public ?int $budgetAreaId = null,
        public ?string $currency = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            externalCost: $data['external_cost'] ?? null,
            markup: $data['markup'] ?? null,
            notes: $data['notes'] ?? null,
            quantity: $data['quantity'] ?? null,
            budgetAreaId: $data['budget_area_id'] ?? null,
            currency: $data['currency'] ?? null,
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
