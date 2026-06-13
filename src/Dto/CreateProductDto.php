<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateProductDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
        public ?string $availableFrom = null,
        public ?string $availableTo = null,
        public ?float $externalCost = null,
        public ?int $markup = null,
        public ?float $price = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            availableFrom: $data['available_from'] ?? null,
            availableTo: $data['available_to'] ?? null,
            externalCost: $data['external_cost'] ?? null,
            markup: $data['markup'] ?? null,
            price: $data['price'] ?? null,
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
