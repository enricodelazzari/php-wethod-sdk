<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateEmployeePayrollDto
{
    public function __construct(
        public ?int $personId = null,
        public ?int $businessUnitId = null,
        public ?int $taxes = null,
        public mixed $from = null,
        public mixed $to = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            personId: $data['person_id'] ?? null,
            businessUnitId: $data['business_unit_id'] ?? null,
            taxes: $data['taxes'] ?? null,
            from: $data['from'] ?? null,
            to: $data['to'] ?? null,
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
