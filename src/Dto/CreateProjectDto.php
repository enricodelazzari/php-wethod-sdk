<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateProjectDto
{
    public function __construct(
        public ?string $name = null,
        public ?int $clientId = null,
        public ?int $clientContactId = null,
        public ?string $purchaseOrder = null,
        public ?int $pmId = null,
        public ?int $accountId = null,
        public ?int $jobOrderCategoryId = null,
        public ?int $projectTypeId = null,
        public ?string $jobOrder = null,
        public mixed $value = null,
        public ?int $probability = null,
        public ?int $externalCostPercentage = null,
        public ?string $startDate = null,
        public ?int $duration = null,
        public ?string $dueDate = null,
        public ?string $signedOn = null,
        public ?int $businessUnitId = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            clientId: $data['client_id'] ?? null,
            clientContactId: $data['client_contact_id'] ?? null,
            purchaseOrder: $data['purchase_order'] ?? null,
            pmId: $data['pm_id'] ?? null,
            accountId: $data['account_id'] ?? null,
            jobOrderCategoryId: $data['job_order_category_id'] ?? null,
            projectTypeId: $data['project_type_id'] ?? null,
            jobOrder: $data['job_order'] ?? null,
            value: $data['value'] ?? null,
            probability: $data['probability'] ?? null,
            externalCostPercentage: $data['external_cost_percentage'] ?? null,
            startDate: $data['start_date'] ?? null,
            duration: $data['duration'] ?? null,
            dueDate: $data['due_date'] ?? null,
            signedOn: $data['signed_on'] ?? null,
            businessUnitId: $data['business_unit_id'] ?? null,
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
