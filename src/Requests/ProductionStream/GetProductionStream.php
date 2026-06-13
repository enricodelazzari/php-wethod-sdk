<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductionStream;

use EnricoDeLazzari\Wethod\Dto\ProductionStreamDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a production stream
 */
class GetProductionStream extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/production-streams/{$this->id}";
    }

    public function __construct(
        protected int $id,
        protected ?string $deleted = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['deleted' => $this->deleted]);
    }

    public function createDtoFromResponse(Response $response): ProductionStreamDto
    {
        return ProductionStreamDto::from($response->json());
    }
}
