<?php

namespace App\Services\Yandex\Direct\DTO;

class DynamicTextAdTargetAddItem
{
    public function __construct(
        public readonly int $adGroupId,
        public readonly string $condition,
        public readonly ?int $bid = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            adGroupId: $data['AdGroupId'],
            condition: $data['Condition'],
            bid: $data['Bid'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'AdGroupId' => $this->adGroupId,
            'Condition' => $this->condition,
            'Bid' => $this->bid,
        ]);
    }
} 