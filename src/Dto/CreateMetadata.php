<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateMetadata
{
    public function __construct(
        public ?string $key = null,
        public ?array $values = null,
        public ?bool $isRequired = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            key: $data['key'] ?? null,
            values: $data['values'] ?? null,
            isRequired: $data['is_required'] ?? null,
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
