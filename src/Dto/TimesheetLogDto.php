<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class TimesheetLogDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $personId = null,
        public ?string $date = null,
        public ?int $projectId = null,
        public ?int $toProjectId = null,
        public ?string $mode = null,
        public ?float $fromHours = null,
        public ?float $toHours = null,
        public ?int $authorId = null,
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
            personId: $data['person_id'] ?? null,
            date: $data['date'] ?? null,
            projectId: $data['project_id'] ?? null,
            toProjectId: $data['to_project_id'] ?? null,
            mode: $data['mode'] ?? null,
            fromHours: $data['from_hours'] ?? null,
            toHours: $data['to_hours'] ?? null,
            authorId: $data['author_id'] ?? null,
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
