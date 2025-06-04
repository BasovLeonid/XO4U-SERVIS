<?php

namespace App\Services\Yandex\Direct\DTO\Feed;

class FeedGetRequest
{
    public function __construct(
        public readonly array $fieldNames,
        public readonly ?array $selectionCriteria = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            fieldNames: $data['FieldNames'],
            selectionCriteria: $data['SelectionCriteria'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'FieldNames' => $this->fieldNames,
            'SelectionCriteria' => $this->selectionCriteria,
        ]);
    }
} 