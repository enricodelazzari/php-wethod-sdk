<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class PriceListLevelDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $priceListId = null,
        public ?int $levelId = null,
        public ?int $price = null,
        public ?int $cost = null,
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
            priceListId: $data['price_list_id'] ?? null,
            levelId: $data['level_id'] ?? null,
            price: $data['price'] ?? null,
            cost: $data['cost'] ?? null,
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
