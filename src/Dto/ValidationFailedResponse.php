<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class ValidationFailedResponse
{
    public function __construct(
        public mixed $headers = null,
        public ?string $content = null,
        public ?string $version = null,
        public ?int $statusCode = null,
        public ?string $statusText = null,
        public ?string $charset = null,
        public ?string $callback = null,
        public ?int $encodingOptions = null,
        public ?string $key = null,
        public ?string $message = null,
        public ?array $failures = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            headers: $data['headers'] ?? null,
            content: $data['content'] ?? null,
            version: $data['version'] ?? null,
            statusCode: $data['status_code'] ?? null,
            statusText: $data['status_text'] ?? null,
            charset: $data['charset'] ?? null,
            callback: $data['callback'] ?? null,
            encodingOptions: $data['encoding_options'] ?? null,
            key: $data['key'] ?? null,
            message: $data['message'] ?? null,
            failures: $data['failures'] ?? null,
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
