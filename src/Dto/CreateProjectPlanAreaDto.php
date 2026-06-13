<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class CreateProjectPlanAreaDto
{
    public function __construct(
        public ?string $name = null,
        public ?int $projectId = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            projectId: $data['project_id'] ?? null,
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
