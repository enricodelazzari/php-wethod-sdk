<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class TimesheetAreaDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $timesheetId = null,
        public ?string $date = null,
        public ?int $budgetAreaId = null,
        public ?string $notes = null,
        public mixed $ordinaryHours = null,
        public mixed $remoteHours = null,
        public mixed $travelHours = null,
        public mixed $overtimeHours = null,
        public mixed $nightShiftHours = null,
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
            timesheetId: $data['timesheet_id'] ?? null,
            date: $data['date'] ?? null,
            budgetAreaId: $data['budget_area_id'] ?? null,
            notes: $data['notes'] ?? null,
            ordinaryHours: $data['ordinary_hours'] ?? null,
            remoteHours: $data['remote_hours'] ?? null,
            travelHours: $data['travel_hours'] ?? null,
            overtimeHours: $data['overtime_hours'] ?? null,
            nightShiftHours: $data['night_shift_hours'] ?? null,
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
