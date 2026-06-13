<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class BudgetPriceListLevelDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $budgetId = null,
        public ?int $priceListId = null,
        public ?int $levelId = null,
        public ?string $levelName = null,
        public ?string $levelCode = null,
        public ?float $levelCost = null,
        public ?float $levelPrice = null,
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
            budgetId: $data['budget_id'] ?? null,
            priceListId: $data['price_list_id'] ?? null,
            levelId: $data['level_id'] ?? null,
            levelName: $data['level_name'] ?? null,
            levelCode: $data['level_code'] ?? null,
            levelCost: $data['level_cost'] ?? null,
            levelPrice: $data['level_price'] ?? null,
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
