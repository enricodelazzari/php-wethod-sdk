<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\ContactDto;
use EnricoDeLazzari\Wethod\Requests\Contact\CreateContact;
use EnricoDeLazzari\Wethod\Requests\Contact\DeleteContact;
use EnricoDeLazzari\Wethod\Requests\Contact\GetContact;
use EnricoDeLazzari\Wethod\Requests\Contact\ListContacts;
use EnricoDeLazzari\Wethod\Requests\Contact\UpdateContact;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Contact extends BaseResource
{
    /**
     * @return array<int, ContactDto>
     */
    public function listContacts(?int $clientId = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListContacts($clientId, $limit, $offset, $updatedAt))->dto();
    }

    public function getContact(int $id): ContactDto
    {
        return $this->connector->send(new GetContact($id))->dto();
    }

    public function createContact(array $data = []): ContactDto
    {
        return $this->connector->send(new CreateContact($data))->dto();
    }

    public function deleteContact(int $id): Response
    {
        return $this->connector->send(new DeleteContact($id));
    }

    public function updateContact(int $id, array $data = []): ContactDto
    {
        return $this->connector->send(new UpdateContact($id, $data))->dto();
    }
}
