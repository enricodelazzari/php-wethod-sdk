<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProjectStatusAreaDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?float $daysLeft = null,
        public ?float $progress = null,
        public ?int $projectStatusId = null,
        public ?int $budgetAreaId = null,
        public ?string $deletedAt = null,
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
            daysLeft: $data['days_left'] ?? null,
            progress: $data['progress'] ?? null,
            projectStatusId: $data['project_status_id'] ?? null,
            budgetAreaId: $data['budget_area_id'] ?? null,
            deletedAt: $data['deleted_at'] ?? null,
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
