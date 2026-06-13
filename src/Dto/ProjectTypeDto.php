<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ProjectTypeDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?string $color = null,
        public ?bool $isChargeable = null,
        public ?bool $isAllocationRequestRequired = null,
        public ?bool $isPlanningAllowedToEverybody = null,
        public ?bool $isPlanningUnlimited = null,
        public ?string $hoursType = null,
        public ?bool $isProgramRequired = null,
        public ?bool $isBudgetInvoiceDriven = null,
        public ?bool $isCapex = null,
        public ?string $externalCostsType = null,
        public ?bool $isWonLostFeedbackRequired = null,
        public ?bool $isOpportunityStatusTrackingEnabled = null,
        public ?bool $isTimesheetAutomatic = null,
        public ?bool $isExternalDriveCanvasEnabled = null,
        public ?string $projectStatusMode = null,
        public ?bool $isProjectReviewRequired = null,
        public ?int $projectReviewValueThreshold = null,
        public ?int $jobOrderCategoryGroupId = null,
        public ?int $jobOrderTemplateId = null,
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
            color: $data['color'] ?? null,
            isChargeable: $data['is_chargeable'] ?? null,
            isAllocationRequestRequired: $data['is_allocation_request_required'] ?? null,
            isPlanningAllowedToEverybody: $data['is_planning_allowed_to_everybody'] ?? null,
            isPlanningUnlimited: $data['is_planning_unlimited'] ?? null,
            hoursType: $data['hours_type'] ?? null,
            isProgramRequired: $data['is_program_required'] ?? null,
            isBudgetInvoiceDriven: $data['is_budget_invoice_driven'] ?? null,
            isCapex: $data['is_capex'] ?? null,
            externalCostsType: $data['external_costs_type'] ?? null,
            isWonLostFeedbackRequired: $data['is_won_lost_feedback_required'] ?? null,
            isOpportunityStatusTrackingEnabled: $data['is_opportunity_status_tracking_enabled'] ?? null,
            isTimesheetAutomatic: $data['is_timesheet_automatic'] ?? null,
            isExternalDriveCanvasEnabled: $data['is_external_drive_canvas_enabled'] ?? null,
            projectStatusMode: $data['project_status_mode'] ?? null,
            isProjectReviewRequired: $data['is_project_review_required'] ?? null,
            projectReviewValueThreshold: $data['project_review_value_threshold'] ?? null,
            jobOrderCategoryGroupId: $data['job_order_category_group_id'] ?? null,
            jobOrderTemplateId: $data['job_order_template_id'] ?? null,
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
