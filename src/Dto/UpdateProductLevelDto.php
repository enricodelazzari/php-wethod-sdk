<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateProductLevelDto
{
    public function __construct(
        public ?float $days = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
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
