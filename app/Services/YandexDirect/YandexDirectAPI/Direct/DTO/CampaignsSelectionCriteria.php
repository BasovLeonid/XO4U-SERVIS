<?php

namespace App\Services\Yandex\Direct\DTO;

class CampaignsSelectionCriteria
{
    public function __construct(
        public readonly ?array $ids = null,
        public readonly ?array $types = null,
        public readonly ?array $states = null,
        public readonly ?array $statuses = null,
        public readonly ?array $statusesPayment = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            ids: $data['Ids'] ?? null,
            types: $data['Types'] ?? null,
            states: $data['States'] ?? null,
            statuses: $data['Statuses'] ?? null,
            statusesPayment: $data['StatusesPayment'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Ids' => $this->ids,
            'Types' => $this->types,
            'States' => $this->states,
            'Statuses' => $this->statuses,
            'StatusesPayment' => $this->statusesPayment,
        ]);
    }
} 