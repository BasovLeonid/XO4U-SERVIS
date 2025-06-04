<?php

namespace App\Services\Yandex\Direct\DTO;

class SitelinksGetRequest
{
    public function __construct(
        public readonly array $selectionCriteria,
        public readonly array $fieldNames,
        public readonly ?array $page = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            selectionCriteria: $data['SelectionCriteria'],
            fieldNames: $data['FieldNames'],
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