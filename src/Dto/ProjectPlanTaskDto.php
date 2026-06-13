<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProjectPlanTaskDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?float $sort = null,
        public ?int $projectPlanAreaId = null,
        public ?int $budgetTaskId = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?string $notes = null,
        public ?string $statusKey = null,
        public ?int $dependsOnId = null,
        public ?string $dependencyType = null,
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
            name: $data['name'] ?? null,
            sort: $data['sort'] ?? null,
            projectPlanAreaId: $data['project_plan_area_id'] ?? null,
            budgetTaskId: $data['budget_task_id'] ?? null,
            startDate: $data['start_date'] ?? null,
            endDate: $data['end_date'] ?? null,
            notes: $data['notes'] ?? null,
            statusKey: $data['status_key'] ?? null,
            dependsOnId: $data['depends_on_id'] ?? null,
            dependencyType: $data['dependency_type'] ?? null,
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
