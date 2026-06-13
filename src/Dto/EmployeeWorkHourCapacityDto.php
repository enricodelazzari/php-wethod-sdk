<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class EmployeeWorkHourCapacityDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $personId = null,
        public ?int $capacityId = null,
        public ?string $deletedAt = null,
        public ?string $startsAt = null,
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
            capacityId: $data['capacity_id'] ?? null,
            deletedAt: $data['deleted_at'] ?? null,
            startsAt: $data['starts_at'] ?? null,
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
