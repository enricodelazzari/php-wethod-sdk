<?php

namespace EnricoDeLazzari\Wethod\Requests\JobTitle;

use EnricoDeLazzari\Wethod\Dto\JobTitleDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a job title
 */
class GetJobTitle extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/job-titles/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): JobTitleDto
    {
        return JobTitleDto::from($response->json());
    }
}
