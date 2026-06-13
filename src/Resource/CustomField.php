<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\CustomFieldDto;
use EnricoDeLazzari\Wethod\Requests\CustomField\ArchiveCustomField;
use EnricoDeLazzari\Wethod\Requests\CustomField\CreateCustomField;
use EnricoDeLazzari\Wethod\Requests\CustomField\DeleteCustomField;
use EnricoDeLazzari\Wethod\Requests\CustomField\GetCustomField;
use EnricoDeLazzari\Wethod\Requests\CustomField\ListCustomFields;
use EnricoDeLazzari\Wethod\Requests\CustomField\UnarchiveCustomField;
use EnricoDeLazzari\Wethod\Requests\CustomField\UpdateCustomField;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class CustomField extends BaseResource
{
    /**
     * @return array<int, CustomFieldDto>
     */
    public function listCustomFields(?string $domain = null, ?string $include = null, ?string $order = null, ?string $search = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null, ?string $archived = null, ?string $archivedAt = null): array
    {
        return $this->connector->send(new ListCustomFields($domain, $include, $order, $search, $limit, $offset, $updatedAt, $deleted, $deletedAt, $archived, $archivedAt))->dto();
    }

    public function createCustomField(array $data = []): CustomFieldDto
    {
        return $this->connector->send(new CreateCustomField($data))->dto();
    }

    public function getCustomField(int $id): CustomFieldDto
    {
        return $this->connector->send(new GetCustomField($id))->dto();
    }

    public function deleteCustomField(int $id): Response
    {
        return $this->connector->send(new DeleteCustomField($id));
    }

    public function updateCustomField(int $id, array $data = []): CustomFieldDto
    {
        return $this->connector->send(new UpdateCustomField($id, $data))->dto();
    }

    public function archiveCustomField(int $id): CustomFieldDto
    {
        return $this->connector->send(new ArchiveCustomField($id))->dto();
    }

    public function unarchiveCustomField(int $id): CustomFieldDto
    {
        return $this->connector->send(new UnarchiveCustomField($id))->dto();
    }
}
