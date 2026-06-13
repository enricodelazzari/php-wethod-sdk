<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ContactDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $clientId = null,
        public ?string $email = null,
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $role = null,
        public ?string $notes = null,
        public ?string $linkedin = null,
        public ?string $description = null,
        public ?int $telephone = null,
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
            clientId: $data['client_id'] ?? null,
            email: $data['email'] ?? null,
            name: $data['name'] ?? null,
            surname: $data['surname'] ?? null,
            role: $data['role'] ?? null,
            notes: $data['notes'] ?? null,
            linkedin: $data['linkedin'] ?? null,
            description: $data['description'] ?? null,
            telephone: $data['telephone'] ?? null,
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
