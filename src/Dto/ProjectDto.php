<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProjectDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?string $jobOrder = null,
        public ?string $purchaseOrder = null,
        public mixed $value = null,
        public ?int $probability = null,
        public ?int $externalCostPercentage = null,
        public ?string $dateStart = null,
        public ?int $duration = null,
        public ?bool $isArchived = null,
        public ?string $archivedOn = null,
        public ?string $dueDate = null,
        public ?string $signedOn = null,
        public ?bool $isTimesheetWhitelistEnabled = null,
        public ?int $jobOrderCategoryId = null,
        public ?int $projectTypeId = null,
        public ?int $clientId = null,
        public ?int $pmId = null,
        public ?int $accountId = null,
        public ?int $clientContactId = null,
        public ?int $reasonWhyId = null,
        public ?int $businessUnitId = null,
        public ?int $billingGroupId = null,
        public ?int $projectStageId = null,
        public ?ProjectTypeDto $jobOrderCategory = null,
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
            jobOrder: $data['job_order'] ?? null,
            purchaseOrder: $data['purchase_order'] ?? null,
            value: $data['value'] ?? null,
            probability: $data['probability'] ?? null,
            externalCostPercentage: $data['external_cost_percentage'] ?? null,
            dateStart: $data['date_start'] ?? null,
            duration: $data['duration'] ?? null,
            isArchived: $data['is_archived'] ?? null,
            archivedOn: $data['archived_on'] ?? null,
            dueDate: $data['due_date'] ?? null,
            signedOn: $data['signed_on'] ?? null,
            isTimesheetWhitelistEnabled: $data['is_timesheet_whitelist_enabled'] ?? null,
            jobOrderCategoryId: $data['job_order_category_id'] ?? null,
            projectTypeId: $data['project_type_id'] ?? null,
            clientId: $data['client_id'] ?? null,
            pmId: $data['pm_id'] ?? null,
            accountId: $data['account_id'] ?? null,
            clientContactId: $data['client_contact_id'] ?? null,
            reasonWhyId: $data['reason_why_id'] ?? null,
            businessUnitId: $data['business_unit_id'] ?? null,
            billingGroupId: $data['billing_group_id'] ?? null,
            projectStageId: $data['project_stage_id'] ?? null,
            jobOrderCategory: isset($data['job_order_category']) ? ProjectTypeDto::from($data['job_order_category']) : null,
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
