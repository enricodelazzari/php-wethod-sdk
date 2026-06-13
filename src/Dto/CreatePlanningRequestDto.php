<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreatePlanningRequestDto
{
    public function __construct(
        public ?int $personId = null,
        public ?int $projectId = null,
        public ?string $date = null,
        public ?int $hours = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            personId: $data['person_id'] ?? null,
            projectId: $data['project_id'] ?? null,
            date: $data['date'] ?? null,
            hours: $data['hours'] ?? null,
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
