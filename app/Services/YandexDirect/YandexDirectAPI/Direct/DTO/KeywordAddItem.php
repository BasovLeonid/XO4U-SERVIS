<?php

namespace App\Services\Yandex\Direct\DTO;

class KeywordAddItem
{
    public function __construct(
        public readonly int $adGroupId,
        public readonly string $keyword,
        public readonly ?array $userParam1 = null,
        public readonly ?array $userParam2 = null,
        public readonly ?array $productivity = null,
        public readonly ?array $statisticsSearch = null,
        public readonly ?array $statisticsNetwork = null,
        public readonly ?array $servingStatus = null,
        public readonly ?array $autotargetingCategories = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            adGroupId: $data['AdGroupId'],
            keyword: $data['Keyword'],
            userParam1: $data['UserParam1'] ?? null,
            userParam2: $data['UserParam2'] ?? null,
            productivity: $data['Productivity'] ?? null,
            statisticsSearch: $data['StatisticsSearch'] ?? null,
            statisticsNetwork: $data['StatisticsNetwork'] ?? null,
            servingStatus: $data['ServingStatus'] ?? null,
            autotargetingCategories: $data['AutotargetingCategories'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'AdGroupId' => $this->adGroupId,
            'Keyword' => $this->keyword,
            'UserParam1' => $this->userParam1,
            'UserParam2' => $this->userParam2,
            'Productivity' => $this->productivity,
            'StatisticsSearch' => $this->statisticsSearch,
            'StatisticsNetwork' => $this->statisticsNetwork,
            'ServingStatus' => $this->servingStatus,
            'AutotargetingCategories' => $this->autotargetingCategories,
        ]);
    }
} 