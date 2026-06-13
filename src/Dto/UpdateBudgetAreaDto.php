<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateBudgetAreaDto
{
    public function __construct(
        public ?string $name = null,
        public ?bool $enabled = null,
        public ?int $priceListId = null,
        public ?int $streamId = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            enabled: $data['enabled'] ?? null,
            priceListId: $data['price_list_id'] ?? null,
            streamId: $data['stream_id'] ?? null,
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
