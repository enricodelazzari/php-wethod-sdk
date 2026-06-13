<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateTimesheetDto
{
    public function __construct(
        public ?int $id = null,
        public mixed $hours = null,
        public ?string $notes = null,
        public ?string $mode = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            hours: $data['hours'] ?? null,
            notes: $data['notes'] ?? null,
            mode: $data['mode'] ?? null,
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
