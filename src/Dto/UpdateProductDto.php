<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateProductDto
{
    public function __construct(
        public ?string $availableFrom = null,
        public ?string $availableTo = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            availableFrom: $data['available_from'] ?? null,
            availableTo: $data['available_to'] ?? null,
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
