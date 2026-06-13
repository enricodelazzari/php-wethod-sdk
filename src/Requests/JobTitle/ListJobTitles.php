<?php

namespace EnricoDeLazzari\Wethod\Requests\JobTitle;

use EnricoDeLazzari\Wethod\Dto\JobTitleDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

/**
 * List job titles
 */
class ListJobTitles extends Request implements Paginatable
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/api/job-titles';
    }

    public function __construct(
        protected ?int $levelId = null,
        protected ?int $limit = null,
        protected ?int $offset = null,
        protected ?string $updatedAt = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['level_id' => $this->levelId, 'limit' => $this->limit, 'offset' => $this->offset, 'updated_at' => $this->updatedAt]);
    }

    /**
     * @return array<int, JobTitleDto>
     */
    public function createDtoFromResponse(Response $response): array
    {
        return JobTitleDto::collect($response->json());
    }
}
