<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\CustomFieldOptionDto;
use EnricoDeLazzari\Wethod\Requests\CustomFieldOption\CreateCustomFieldOption;
use EnricoDeLazzari\Wethod\Requests\CustomFieldOption\DeleteCustomFieldOption;
use EnricoDeLazzari\Wethod\Requests\CustomFieldOption\GetCustomFieldOption;
use EnricoDeLazzari\Wethod\Requests\CustomFieldOption\ListCustomFieldOptions;
use EnricoDeLazzari\Wethod\Requests\CustomFieldOption\UpdateCustomFieldOption;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class CustomFieldOption extends BaseResource
{
    /**
     * @return array<int, CustomFieldOptionDto>
     */
    public function listCustomFieldOptions(?int $customFieldId = null, ?string $order = null, ?string $search = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null, ?string $deleted = null, ?string $deletedAt = null): array
    {
        return $this->connector->send(new ListCustomFieldOptions($customFieldId, $order, $search, $limit, $offset, $updatedAt, $deleted, $deletedAt))->dto();
    }

    public function createCustomFieldOption(array $data = []): CustomFieldOptionDto
    {
        return $this->connector->send(new CreateCustomFieldOption($data))->dto();
    }

    public function getCustomFieldOption(int $id): CustomFieldOptionDto
    {
        return $this->connector->send(new GetCustomFieldOption($id))->dto();
    }

    public function deleteCustomFieldOption(int $id): Response
    {
        return $this->connector->send(new DeleteCustomFieldOption($id));
    }

    public function updateCustomFieldOption(int $id, array $data = []): CustomFieldOptionDto
    {
        return $this->connector->send(new UpdateCustomFieldOption($id, $data))->dto();
    }
}
