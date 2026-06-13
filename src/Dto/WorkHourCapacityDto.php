<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class WorkHourCapacityDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?int $mondayMinutes = null,
        public ?int $tuesdayMinutes = null,
        public ?int $wednesdayMinutes = null,
        public ?int $thursdayMinutes = null,
        public ?int $fridayMinutes = null,
        public ?int $saturdayMinutes = null,
        public ?int $sundayMinutes = null,
        public ?bool $isDefault = null,
        public ?string $archivedAt = null,
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
            name: $data['name'] ?? null,
            mondayMinutes: $data['monday_minutes'] ?? null,
            tuesdayMinutes: $data['tuesday_minutes'] ?? null,
            wednesdayMinutes: $data['wednesday_minutes'] ?? null,
            thursdayMinutes: $data['thursday_minutes'] ?? null,
            fridayMinutes: $data['friday_minutes'] ?? null,
            saturdayMinutes: $data['saturday_minutes'] ?? null,
            sundayMinutes: $data['sunday_minutes'] ?? null,
            isDefault: $data['is_default'] ?? null,
            archivedAt: $data['archived_at'] ?? null,
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
