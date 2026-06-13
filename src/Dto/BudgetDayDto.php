<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class BudgetDayDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?float $days = null,
        public ?string $uid = null,
        public ?int $budgetJobTitleId = null,
        public ?int $budgetPriceListLevelId = null,
        public ?int $budgetTaskId = null,
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
            days: $data['days'] ?? null,
            uid: $data['uid'] ?? null,
            budgetJobTitleId: $data['budget_job_title_id'] ?? null,
            budgetPriceListLevelId: $data['budget_price_list_level_id'] ?? null,
            budgetTaskId: $data['budget_task_id'] ?? null,
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
