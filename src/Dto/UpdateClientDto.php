<?php

namespace EnricoDeLazzari\Wethod\Dto;

final readonly class UpdateClientDto
{
    public function __construct(
        public ?string $corporateName = null,
        public ?string $acronym = null,
        public ?string $email = null,
        public ?string $notes = null,
        public ?string $website = null,
        public ?string $linkedin = null,
        public ?string $description = null,
        public ?string $street = null,
        public ?string $zipCode = null,
        public ?string $town = null,
        public ?string $country = null,
        public ?string $vat = null,
        public ?string $paymentCondition = null,
        public ?string $sdiCode = null,
        public ?string $pec = null,
        public ?string $administrationEmail = null,
        public ?string $companyRegistrationNumber = null,
        public ?string $legalName = null,
        public ?string $intentCode = null,
        public ?string $intentDate = null,
        public ?string $phone = null,
        public ?string $taxReference = null,
        public ?int $groupId = null,
        public ?int $bankAccountId = null,
        public ?int $vatRateId = null,
        public ?int $paymentTermId = null,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function from(array $data): self
    {
        return new self(
            corporateName: $data['corporate_name'] ?? null,
            acronym: $data['acronym'] ?? null,
            email: $data['email'] ?? null,
            notes: $data['notes'] ?? null,
            website: $data['website'] ?? null,
            linkedin: $data['linkedin'] ?? null,
            description: $data['description'] ?? null,
            street: $data['street'] ?? null,
            zipCode: $data['zip_code'] ?? null,
            town: $data['town'] ?? null,
            country: $data['country'] ?? null,
            vat: $data['vat'] ?? null,
            paymentCondition: $data['payment_condition'] ?? null,
            sdiCode: $data['sdi_code'] ?? null,
            pec: $data['pec'] ?? null,
            administrationEmail: $data['administration_email'] ?? null,
            companyRegistrationNumber: $data['company_registration_number'] ?? null,
            legalName: $data['legal_name'] ?? null,
            intentCode: $data['intent_code'] ?? null,
            intentDate: $data['intent_date'] ?? null,
            phone: $data['phone'] ?? null,
            taxReference: $data['tax_reference'] ?? null,
            groupId: $data['group_id'] ?? null,
            bankAccountId: $data['bank_account_id'] ?? null,
            vatRateId: $data['vat_rate_id'] ?? null,
            paymentTermId: $data['payment_term_id'] ?? null,
        );
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return array<int, self>
     */
    public static function collect(array $items): array
    {
        return array_map(static fn (array $item): self => self::from($item), $items);
    }
}
