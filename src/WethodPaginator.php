<?php

namespace EnricoDeLazzari\Wethod;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\OffsetPaginator;

/**
 * Offset/limit paginator for Wethod list endpoints.
 *
 * Wethod list responses are bare JSON arrays with no total count, so a page is
 * considered the last one as soon as it returns fewer items than the limit.
 */
class WethodPaginator extends OffsetPaginator
{
    protected ?int $perPageLimit = 100;

    protected function isLastPage(Response $response): bool
    {
        return count($this->getPageItems($response, $response->getRequest())) < $this->perPageLimit;
    }

    /**
     * @return array<int, mixed>
     */
    protected function getPageItems(Response $response, Request $request): array
    {
        return (array) $response->json();
    }
}
