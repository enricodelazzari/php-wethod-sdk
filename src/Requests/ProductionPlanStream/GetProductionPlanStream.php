<?php

namespace EnricoDeLazzari\Wethod\Requests\ProductionPlanStream;

use EnricoDeLazzari\Wethod\Dto\ProductionPlanStreamDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a production plan stream
 */
class GetProductionPlanStream extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/production-plan-streams/{$this->id}";
    }

    public function __construct(
        protected int $id,
        protected ?string $deleted = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['deleted' => $this->deleted]);
    }

    public function createDtoFromResponse(Response $response): ProductionPlanStreamDto
    {
        return ProductionPlanStreamDto::from($response->json());
    }
}
