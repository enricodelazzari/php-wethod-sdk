<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateBudgetDto
{
    public function __construct(
        public ?int $projectId = null,
        public ?int $priceListId = null,
        public ?int $streamId = null,
        public ?int $templateId = null,
        public ?float $finalNetPrice = null,
        public ?string $notes = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            projectId: $data['project_id'] ?? null,
            priceListId: $data['price_list_id'] ?? null,
            streamId: $data['stream_id'] ?? null,
            templateId: $data['template_id'] ?? null,
            finalNetPrice: $data['final_net_price'] ?? null,
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
