<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProductionPlanStreamDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $date = null,
        public mixed $value = null,
        public ?int $projectId = null,
        public ?int $streamId = null,
        public ?int $productionPlanId = null,
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
            date: $data['date'] ?? null,
            value: $data['value'] ?? null,
            projectId: $data['project_id'] ?? null,
            streamId: $data['stream_id'] ?? null,
            productionPlanId: $data['production_plan_id'] ?? null,
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
