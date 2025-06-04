<?php

namespace App\Services\Yandex\Direct\DTO;

class SmartAdTargetAddItem
{
    public function __construct(
        public readonly string $name,
        public readonly int $adGroupId,
        public readonly string $audience,
        public readonly ?int $averageCpc = null,
        public readonly ?int $averageCpa = null,
        public readonly ?string $strategyPriority = null,
        public readonly ?array $conditions = null,
        public readonly ?string $availableItemsOnly = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['Name'],
            adGroupId: $data['AdGroupId'],
            audience: $data['Audience'],
            averageCpc: $data['AverageCpc'] ?? null,
            averageCpa: $data['AverageCpa'] ?? null,
            strategyPriority: $data['StrategyPriority'] ?? null,
            conditions: $data['Conditions'] ?? null,
            availableItemsOnly: $data['AvailableItemsOnly'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Name' => $this->name,
            'AdGroupId' => $this->adGroupId,
            'Audience' => $this->audience,
            'AverageCpc' => $this->averageCpc,
            'AverageCpa' => $this->averageCpa,
            'StrategyPriority' => $this->strategyPriority,
            'Conditions' => $this->conditions,
            'AvailableItemsOnly' => $this->availableItemsOnly,
        ]);
    }
} 