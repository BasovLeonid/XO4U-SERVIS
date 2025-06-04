<?php

namespace App\Services\Yandex\Direct\DTO;

class AudienceTargetAddItem
{
    public function __construct(
        public readonly int $adGroupId,
        public readonly ?int $retargetingListId = null,
        public readonly ?int $interestId = null,
        public readonly ?int $contextBid = null,
        public readonly ?string $strategyPriority = null,
    ) {
        if ($this->retargetingListId === null && $this->interestId === null) {
            throw new \InvalidArgumentException('Either retargetingListId or interestId must be provided');
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            adGroupId: $data['AdGroupId'],
            retargetingListId: $data['RetargetingListId'] ?? null,
            interestId: $data['InterestId'] ?? null,
            contextBid: $data['ContextBid'] ?? null,
            strategyPriority: $data['StrategyPriority'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'AdGroupId' => $this->adGroupId,
            'RetargetingListId' => $this->retargetingListId,
            'InterestId' => $this->interestId,
            'ContextBid' => $this->contextBid,
            'StrategyPriority' => $this->strategyPriority,
        ]);
    }
} 