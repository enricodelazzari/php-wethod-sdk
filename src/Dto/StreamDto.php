<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class StreamDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public mixed $isDefault = null,
        public ?string $archivedAt = null,
        public ?array $streamLeaders = null,
        public ?array $streamMembers = null,
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
            isDefault: $data['is_default'] ?? null,
            archivedAt: $data['archived_at'] ?? null,
            streamLeaders: $data['stream_leaders'] ?? null,
            streamMembers: $data['stream_members'] ?? null,
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
