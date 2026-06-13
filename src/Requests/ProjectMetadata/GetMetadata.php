<?php

namespace EnricoDeLazzari\Wethod\Requests\ProjectMetadata;

use EnricoDeLazzari\Wethod\Dto\MetadataDTO;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a project metadata
 */
class GetMetadata extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/project-metadata/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): MetadataDTO
    {
        return MetadataDTO::from($response->json());
    }
}
