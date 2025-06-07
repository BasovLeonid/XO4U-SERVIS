<?php

namespace App\Services\Yandex\Direct\DTO;

class NegativeKeywordSharedSetUpdateItem
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?array $negativeKeywords = null,
        public readonly ?array $shared = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'] ?? null,
            negativeKeywords: $data['NegativeKeywords'] ?? null,
            shared: $data['Shared'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Id' => $this->id,
            'Name' => $this->name,
            'NegativeKeywords' => $this->negativeKeywords,
            'Shared' => $this->shared,
        ]);
    }
} 