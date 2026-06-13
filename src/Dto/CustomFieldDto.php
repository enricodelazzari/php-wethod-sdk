<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CustomFieldDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?string $type = null,
        public ?string $domain = null,
        public ?bool $required = null,
        public ?int $sort = null,
        public ?array $options = null,
        public ?string $archivedAt = null,
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
            description: $data['description'] ?? null,
            type: $data['type'] ?? null,
            domain: $data['domain'] ?? null,
            required: $data['required'] ?? null,
            sort: $data['sort'] ?? null,
            options: $data['options'] ?? null,
            archivedAt: $data['archived_at'] ?? null,
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
