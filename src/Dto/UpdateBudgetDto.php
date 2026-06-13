<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateBudgetDto
{
    public function __construct(
        public ?int $priceListId = null,
        public ?int $streamId = null,
        public ?bool $currencyEnabled = null,
        public ?string $currency = null,
        public ?string $notes = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            priceListId: $data['price_list_id'] ?? null,
            streamId: $data['stream_id'] ?? null,
            currencyEnabled: $data['currency_enabled'] ?? null,
            currency: $data['currency'] ?? null,
            notes: $data['notes'] ?? null,
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
