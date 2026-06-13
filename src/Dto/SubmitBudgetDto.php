<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class SubmitBudgetDto
{
    public function __construct(
        public ?int $approverId = null,
        public ?string $message = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            approverId: $data['approver_id'] ?? null,
            message: $data['message'] ?? null,
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
