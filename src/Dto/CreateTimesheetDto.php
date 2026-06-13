<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateTimesheetDto
{
    public function __construct(
        public ?string $date = null,
        public mixed $hours = null,
        public ?string $notes = null,
        public ?string $mode = null,
        public ?int $projectId = null,
        public ?int $personId = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            date: $data['date'] ?? null,
            hours: $data['hours'] ?? null,
            notes: $data['notes'] ?? null,
            mode: $data['mode'] ?? null,
            projectId: $data['project_id'] ?? null,
            personId: $data['person_id'] ?? null,
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
