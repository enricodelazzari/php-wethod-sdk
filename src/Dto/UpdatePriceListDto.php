<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdatePriceListDto
{
    public function __construct(
        public ?int $clientId = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?string $availableFrom = null,
        public ?string $availableTo = null,
        public ?bool $isDefaultForClient = null,
        public ?bool $syncWithCompanyDefault = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            clientId: $data['client_id'] ?? null,
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            availableFrom: $data['available_from'] ?? null,
            availableTo: $data['available_to'] ?? null,
            isDefaultForClient: $data['is_default_for_client'] ?? null,
            syncWithCompanyDefault: $data['sync_with_company_default'] ?? null,
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
