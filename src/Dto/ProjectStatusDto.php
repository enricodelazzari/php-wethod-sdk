<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProjectStatusDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $projectId = null,
        public ?string $date = null,
        public ?float $daysLeft = null,
        public ?float $progress = null,
        public ?string $notes = null,
        public ?int $projectStatusRiskId = null,
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
            projectId: $data['project_id'] ?? null,
            date: $data['date'] ?? null,
            daysLeft: $data['days_left'] ?? null,
            progress: $data['progress'] ?? null,
            notes: $data['notes'] ?? null,
            projectStatusRiskId: $data['project_status_risk_id'] ?? null,
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
