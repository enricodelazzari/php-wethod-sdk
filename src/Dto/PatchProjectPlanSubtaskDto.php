<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class PatchProjectPlanSubtaskDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $notes = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?int $dependsOnId = null,
        public ?int $projectPlanTaskId = null,
        public ?string $dependencyType = null,
        public ?string $statusKey = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            notes: $data['notes'] ?? null,
            startDate: $data['start_date'] ?? null,
            endDate: $data['end_date'] ?? null,
            dependsOnId: $data['depends_on_id'] ?? null,
            projectPlanTaskId: $data['project_plan_task_id'] ?? null,
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
