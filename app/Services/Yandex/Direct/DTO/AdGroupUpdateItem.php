<?php

namespace App\Services\Yandex\Direct\DTO;

class AdGroupUpdateItem
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?array $regionIds = null,
        public readonly ?array $negativeKeywords = null,
        public readonly ?array $trackingParams = null,
        public readonly ?array $mobileAppAdGroup = null,
        public readonly ?array $dynamicTextAdGroup = null,
        public readonly ?array $cpmBannerAdGroup = null,
        public readonly ?array $smartAdGroup = null,
        public readonly ?array $unifiedAdGroup = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'] ?? null,
            regionIds: $data['RegionIds'] ?? null,
            negativeKeywords: $data['NegativeKeywords'] ?? null,
            trackingParams: $data['TrackingParams'] ?? null,
            mobileAppAdGroup: $data['MobileAppAdGroup'] ?? null,
            dynamicTextAdGroup: $data['DynamicTextAdGroup'] ?? null,
            cpmBannerAdGroup: $data['CpmBannerAdGroup'] ?? null,
            smartAdGroup: $data['SmartAdGroup'] ?? null,
            unifiedAdGroup: $data['UnifiedAdGroup'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Id' => $this->id,
            'Name' => $this->name,
            'RegionIds' => $this->regionIds,
            'NegativeKeywords' => $this->negativeKeywords,
            'TrackingParams' => $this->trackingParams,
            'MobileAppAdGroup' => $this->mobileAppAdGroup,
            'DynamicTextAdGroup' => $this->dynamicTextAdGroup,
            'CpmBannerAdGroup' => $this->cpmBannerAdGroup,
            'SmartAdGroup' => $this->smartAdGroup,
            'UnifiedAdGroup' => $this->unifiedAdGroup,
        ]);
    }
} 