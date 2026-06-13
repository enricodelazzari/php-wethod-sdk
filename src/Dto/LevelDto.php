<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class LevelDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?string $code = null,
        public ?float $chargeabilityTarget = null,
        public ?bool $isExternal = null,
        public ?bool $mustBePlanned = null,
        public ?bool $mustDoTimesheet = null,
        public ?bool $isDefaultInBudget = null,
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
            code: $data['code'] ?? null,
            chargeabilityTarget: $data['chargeability_target'] ?? null,
            isExternal: $data['is_external'] ?? null,
            mustBePlanned: $data['must_be_planned'] ?? null,
            mustDoTimesheet: $data['must_do_timesheet'] ?? null,
            isDefaultInBudget: $data['is_default_in_budget'] ?? null,
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
