<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class EmployeeDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $email = null,
        public ?string $name = null,
        public ?string $surname = null,
        public ?int $roleId = null,
        public ?string $role = null,
        public ?bool $isArchived = null,
        public ?bool $isVisibleInPeopleAllocation = null,
        public ?bool $hasTimesheetRequired = null,
        public ?int $levelId = null,
        public ?int $streamId = null,
        public ?int $priceListId = null,
        public ?int $jobTitleId = null,
        public ?int $allocationManagerId = null,
        public ?int $capacityId = null,
        public ?int $locationId = null,
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
            email: $data['email'] ?? null,
            name: $data['name'] ?? null,
            surname: $data['surname'] ?? null,
            roleId: $data['role_id'] ?? null,
            role: $data['role'] ?? null,
            isArchived: $data['is_archived'] ?? null,
            isVisibleInPeopleAllocation: $data['is_visible_in_people_allocation'] ?? null,
            hasTimesheetRequired: $data['has_timesheet_required'] ?? null,
            levelId: $data['level_id'] ?? null,
            streamId: $data['stream_id'] ?? null,
            priceListId: $data['price_list_id'] ?? null,
            jobTitleId: $data['job_title_id'] ?? null,
            allocationManagerId: $data['allocation_manager_id'] ?? null,
            capacityId: $data['capacity_id'] ?? null,
            locationId: $data['location_id'] ?? null,
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
