<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateEmployeeWorkHourCapacityDto
{
    public function __construct(
        public ?int $capacityId = null,
        public ?string $startsAt = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            capacityId: $data['capacity_id'] ?? null,
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
