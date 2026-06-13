<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateProjectStatusDto
{
    public function __construct(
        public mixed $daysLeft = null,
        public mixed $progress = null,
        public ?string $notes = null,
        public ?int $projectStatusRiskId = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            daysLeft: $data['days_left'] ?? null,
            progress: $data['progress'] ?? null,
            notes: $data['notes'] ?? null,
            projectStatusRiskId: $data['project_status_risk_id'] ?? null,
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
