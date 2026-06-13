<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateProjectPlanSubtaskDto
{
    public function __construct(
        public ?int $projectPlanTaskId = null,
        public ?string $name = null,
        public ?string $notes = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?int $dependsOnId = null,
        public ?string $dependencyType = null,
        public ?string $statusKey = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            projectPlanTaskId: $data['project_plan_task_id'] ?? null,
            name: $data['name'] ?? null,
            notes: $data['notes'] ?? null,
            startDate: $data['start_date'] ?? null,
            endDate: $data['end_date'] ?? null,
            dependsOnId: $data['depends_on_id'] ?? null,
            dependencyType: $data['dependency_type'] ?? null,
            statusKey: $data['status_key'] ?? null,
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
