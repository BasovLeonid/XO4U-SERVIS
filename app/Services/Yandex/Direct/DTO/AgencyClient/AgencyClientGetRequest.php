<?php

namespace App\Services\Yandex\Direct\DTO\AgencyClient;

class AgencyClientGetRequest
{
    public function __construct(
        public readonly array $fieldNames,
        public readonly ?array $tinInfoFieldNames = null,
        public readonly ?array $organizationFieldNames = null,
        public readonly ?array $contractFieldNames = null,
        public readonly ?array $contragentFieldNames = null,
        public readonly ?array $contragentTinInfoFieldNames = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            fieldNames: $data['FieldNames'],
            tinInfoFieldNames: $data['TinInfoFieldNames'] ?? null,
            organizationFieldNames: $data['OrganizationFieldNames'] ?? null,
            contractFieldNames: $data['ContractFieldNames'] ?? null,
            contragentFieldNames: $data['ContragentFieldNames'] ?? null,
            contragentTinInfoFieldNames: $data['ContragentTinInfoFieldNames'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'FieldNames' => $this->fieldNames,
            'TinInfoFieldNames' => $this->tinInfoFieldNames,
            'OrganizationFieldNames' => $this->organizationFieldNames,
            'ContractFieldNames' => $this->contractFieldNames,
            'ContragentFieldNames' => $this->contragentFieldNames,
            'ContragentTinInfoFieldNames' => $this->contragentTinInfoFieldNames,
        ]);
    }
} 