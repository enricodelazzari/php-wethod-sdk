<?php

namespace EnricoDeLazzari\Wethod\Requests\Contact;

use EnricoDeLazzari\Wethod\Dto\ContactDto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

/**
 * Get a contact
 */
class GetContact extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/api/contacts/{$this->id}";
    }

    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): ContactDto
    {
        return ContactDto::from($response->json());
    }
}
