<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateBudgetTaskDto
{
    public function __construct(
        public ?string $name = null,
        public mixed $externalCost = null,
        public ?int $markup = null,
        public ?string $notes = null,
        public ?int $quantity = null,
        public mixed $totalPrice = null,
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
            totalPrice: $data['total_price'] ?? null,
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
