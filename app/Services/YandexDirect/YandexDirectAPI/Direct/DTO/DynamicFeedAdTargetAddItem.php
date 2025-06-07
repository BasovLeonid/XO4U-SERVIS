<?php

namespace App\Services\Yandex\Direct\DTO;

class DynamicFeedAdTargetAddItem
{
    public function __construct(
        public readonly int $feedId,
        public readonly string $condition,
        public readonly ?float $bid = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            feedId: $data['FeedId'],
            condition: $data['Condition'],
            bid: $data['Bid'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'FeedId' => $this->feedId,
            'Condition' => $this->condition,
            'Bid' => $this->bid,
        ]);
    }
} 