<?php

namespace App\Services\Yandex\Direct\DTO;

class AdGroupAddItem
{
    public function __construct(
        public readonly string $name,
        public readonly int $campaignId,
        public readonly array $regionIds,
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
            name: $data['Name'],
            campaignId: $data['CampaignId'],
            regionIds: $data['RegionIds'],
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
            'Name' => $this->name,
            'CampaignId' => $this->campaignId,
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