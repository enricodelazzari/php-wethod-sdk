<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class BudgetJobTitleDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $jobTitleId = null,
        public ?int $budgetId = null,
        public ?string $jobTitleName = null,
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
            jobTitleId: $data['job_title_id'] ?? null,
            budgetId: $data['budget_id'] ?? null,
            jobTitleName: $data['job_title_name'] ?? null,
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
