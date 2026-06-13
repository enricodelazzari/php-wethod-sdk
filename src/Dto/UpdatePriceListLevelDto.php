<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdatePriceListLevelDto
{
    public function __construct(
        public ?int $price = null,
        public ?int $cost = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
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
