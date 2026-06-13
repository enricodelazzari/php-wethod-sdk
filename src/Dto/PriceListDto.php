<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class PriceListDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?string $availableFrom = null,
        public ?string $availableTo = null,
        public ?bool $isDefaultForClient = null,
        public ?bool $isDefaultForCompany = null,
        public ?bool $usesDefaultPriceListCosts = null,
        public ?int $clientId = null,
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
            availableFrom: $data['available_from'] ?? null,
            availableTo: $data['available_to'] ?? null,
            isDefaultForClient: $data['is_default_for_client'] ?? null,
            isDefaultForCompany: $data['is_default_for_company'] ?? null,
            usesDefaultPriceListCosts: $data['uses_default_price_list_costs'] ?? null,
            clientId: $data['client_id'] ?? null,
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
