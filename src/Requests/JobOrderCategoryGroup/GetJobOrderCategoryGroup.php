<?php

namespace EnricoDeLazzari\Wethod\Requests\JobOrderCategoryGroup;

use EnricoDeLazzari\Wethod\Dto\ProjectTypeGroupDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a job order category group
 */
class GetJobOrderCategoryGroup extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/job-order-category-groups/{$this->id}";
    }

    public function __construct(
        protected int $id,
        protected ?string $deleted = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['deleted' => $this->deleted]);
    }

    public function createDtoFromResponse(Response $response): ProjectTypeGroupDto
    {
        return ProjectTypeGroupDto::from($response->json());
    }
}
