<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateCustomFieldDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
        public ?bool $required = null,
        public ?int $sort = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            required: $data['required'] ?? null,
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
