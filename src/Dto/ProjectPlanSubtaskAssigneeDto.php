<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProjectPlanSubtaskAssigneeDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $employeeId = null,
        public ?int $projectPlanSubtaskId = null,
        public ?int $hours = null,
        public ?string $strategy = null,
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
            employeeId: $data['employee_id'] ?? null,
            projectPlanSubtaskId: $data['project_plan_subtask_id'] ?? null,
            hours: $data['hours'] ?? null,
            strategy: $data['strategy'] ?? null,
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
