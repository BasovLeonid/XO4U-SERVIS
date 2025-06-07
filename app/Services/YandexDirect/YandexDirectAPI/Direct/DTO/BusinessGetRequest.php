<?php

namespace App\Services\Yandex\Direct\DTO;

class BusinessGetRequest
{
    public function __construct(
        public readonly ?array $selectionCriteria = null,
        public readonly array $fieldNames = [],
        public readonly ?array $page = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            selectionCriteria: $data['SelectionCriteria'] ?? null,
            fieldNames: $data['FieldNames'] ?? [],
            page: $data['Page'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'SelectionCriteria' => $this->selectionCriteria,
            'FieldNames' => $this->fieldNames,
            'Page' => $this->page,
        ]);
    }
} 