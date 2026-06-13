<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateHolidayDto
{
    public function __construct(
        public ?string $name = null,
        public ?bool $repeating = null,
        public ?string $exactDate = null,
        public ?int $repeatingDay = null,
        public ?int $repeatingMonth = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            repeating: $data['repeating'] ?? null,
            exactDate: $data['exact_date'] ?? null,
            repeatingDay: $data['repeating_day'] ?? null,
            repeatingMonth: $data['repeating_month'] ?? null,
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
