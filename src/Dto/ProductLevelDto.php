<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProductLevelDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $productId = null,
        public ?int $levelId = null,
        public ?float $days = null,
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
            productId: $data['product_id'] ?? null,
            levelId: $data['level_id'] ?? null,
            days: $data['days'] ?? null,
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
