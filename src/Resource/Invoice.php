<?php

namespace EnricoDeLazzari\Wethod\Resource;

use EnricoDeLazzari\Wethod\Dto\InvoiceContactDto;
use EnricoDeLazzari\Wethod\Dto\InvoiceDto;
use EnricoDeLazzari\Wethod\Requests\Invoice\CreateInvoice;
use EnricoDeLazzari\Wethod\Requests\Invoice\DeleteInvoice;
use EnricoDeLazzari\Wethod\Requests\Invoice\GetInvoice;
use EnricoDeLazzari\Wethod\Requests\Invoice\GetInvoiceContact;
use EnricoDeLazzari\Wethod\Requests\Invoice\ListInvoiceContacts;
use EnricoDeLazzari\Wethod\Requests\Invoice\ListInvoices;
use EnricoDeLazzari\Wethod\Requests\Invoice\SendInvoice;
use EnricoDeLazzari\Wethod\Requests\Invoice\SetPaidInvoice;
use EnricoDeLazzari\Wethod\Requests\Invoice\SetUnpaidInvoice;
use EnricoDeLazzari\Wethod\Requests\Invoice\UpdateInvoice;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class Invoice extends BaseResource
{
    /**
     * @return array<int, InvoiceContactDto>
     */
    public function listInvoiceContacts(?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListInvoiceContacts($limit, $offset, $updatedAt))->dto();
    }

    public function getInvoiceContact(int $id): InvoiceContactDto
    {
        return $this->connector->send(new GetInvoiceContact($id))->dto();
    }

    /**
     * @return array<int, InvoiceDto>
     */
    public function listInvoices(?int $projectId = null, ?string $issueDate = null, ?string $paymentDate = null, ?int $limit = null, ?int $offset = null, ?string $updatedAt = null): array
    {
        return $this->connector->send(new ListInvoices($projectId, $issueDate, $paymentDate, $limit, $offset, $updatedAt))->dto();
    }

    public function createInvoice(array $data = []): InvoiceDto
    {
        return $this->connector->send(new CreateInvoice($data))->dto();
    }

    public function getInvoice(int $id): InvoiceDto
    {
        return $this->connector->send(new GetInvoice($id))->dto();
    }

    public function deleteInvoice(int $id): Response
    {
        return $this->connector->send(new DeleteInvoice($id));
    }

    public function updateInvoice(int $id, array $data = []): InvoiceDto
    {
        return $this->connector->send(new UpdateInvoice($id, $data))->dto();
    }

    public function sendInvoice(int $id, array $data = []): InvoiceDto
    {
        return $this->connector->send(new SendInvoice($id, $data))->dto();
    }

    public function setPaidInvoice(int $id, array $data = []): InvoiceDto
    {
        return $this->connector->send(new SetPaidInvoice($id, $data))->dto();
    }

    public function setUnpaidInvoice(int $id): InvoiceDto
    {
        return $this->connector->send(new SetUnpaidInvoice($id))->dto();
    }
}
