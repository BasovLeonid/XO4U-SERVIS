<?php

namespace App\Services\Yandex\Direct\DTO;

class NegativeKeywordSharedSetAddItem
{
    public function __construct(
        public readonly string $name,
        public readonly array $negativeKeywords,
        public readonly ?array $shared = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['Name'],
            negativeKeywords: $data['NegativeKeywords'],
            shared: $data['Shared'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Name' => $this->name,
            'NegativeKeywords' => $this->negativeKeywords,
            'Shared' => $this->shared,
        ]);
    }
} 