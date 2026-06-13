<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class StreamMemberDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $streamId = null,
        public ?int $memberId = null,
        public ?string $startsAt = null,
        public ?string $endsAt = null,
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
            streamId: $data['stream_id'] ?? null,
            memberId: $data['member_id'] ?? null,
            startsAt: $data['starts_at'] ?? null,
            endsAt: $data['ends_at'] ?? null,
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
