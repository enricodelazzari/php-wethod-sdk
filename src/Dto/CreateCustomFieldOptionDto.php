<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateCustomFieldOptionDto
{
    public function __construct(
        public ?string $name = null,
        public ?int $customFieldId = null,
        public ?string $color = null,
        public ?int $sort = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            customFieldId: $data['custom_field_id'] ?? null,
            color: $data['color'] ?? null,
            sort: $data['sort'] ?? null,
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
