<?php

namespace EnricoDeLazzari\Wethod\Requests\JobOrderCategory;

use EnricoDeLazzari\Wethod\Dto\ProjectTypeDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a job order category
 */
class GetJobOrderCategory extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/job-order-categories/{$this->id}";
    }

    public function __construct(
        protected int $id,
        protected ?string $deleted = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['deleted' => $this->deleted]);
    }

    public function createDtoFromResponse(Response $response): ProjectTypeDto
    {
        return ProjectTypeDto::from($response->json());
    }
}
