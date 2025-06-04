<?php

namespace App\Services\Yandex\Direct\DTO;

class CampaignGetRequest
{
    public function __construct(
        public readonly ?CampaignsSelectionCriteria $selectionCriteria = null,
        public readonly array $fieldNames = [],
        public readonly ?array $textCampaignFieldNames = null,
        public readonly ?array $textCampaignSearchStrategyPlacementTypesFieldNames = null,
        public readonly ?array $mobileAppCampaignFieldNames = null,
        public readonly ?array $dynamicTextCampaignFieldNames = null,
        public readonly ?array $dynamicTextCampaignSearchStrategyPlacementTypesFieldNames = null,
        public readonly ?array $cpmBannerCampaignFieldNames = null,
        public readonly ?array $smartCampaignFieldNames = null,
        public readonly ?array $unifiedCampaignFieldNames = null,
        public readonly ?array $unifiedCampaignSearchStrategyPlacementTypesFieldNames = null,
        public readonly ?array $unifiedCampaignPackageBiddingStrategyPlatformsFieldNames = null,
        public readonly ?array $page = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            selectionCriteria: isset($data['SelectionCriteria']) ? CampaignsSelectionCriteria::fromArray($data['SelectionCriteria']) : null,
            fieldNames: $data['FieldNames'] ?? [],
            textCampaignFieldNames: $data['TextCampaignFieldNames'] ?? null,
            textCampaignSearchStrategyPlacementTypesFieldNames: $data['TextCampaignSearchStrategyPlacementTypesFieldNames'] ?? null,
            mobileAppCampaignFieldNames: $data['MobileAppCampaignFieldNames'] ?? null,
            dynamicTextCampaignFieldNames: $data['DynamicTextCampaignFieldNames'] ?? null,
            dynamicTextCampaignSearchStrategyPlacementTypesFieldNames: $data['DynamicTextCampaignSearchStrategyPlacementTypesFieldNames'] ?? null,
            cpmBannerCampaignFieldNames: $data['CpmBannerCampaignFieldNames'] ?? null,
            smartCampaignFieldNames: $data['SmartCampaignFieldNames'] ?? null,
            unifiedCampaignFieldNames: $data['UnifiedCampaignFieldNames'] ?? null,
            unifiedCampaignSearchStrategyPlacementTypesFieldNames: $data['UnifiedCampaignSearchStrategyPlacementTypesFieldNames'] ?? null,
            unifiedCampaignPackageBiddingStrategyPlatformsFieldNames: $data['UnifiedCampaignPackageBiddingStrategyPlatformsFieldNames'] ?? null,
            page: $data['Page'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'SelectionCriteria' => $this->selectionCriteria?->toArray(),
            'FieldNames' => $this->fieldNames,
            'TextCampaignFieldNames' => $this->textCampaignFieldNames,
            'TextCampaignSearchStrategyPlacementTypesFieldNames' => $this->textCampaignSearchStrategyPlacementTypesFieldNames,
            'MobileAppCampaignFieldNames' => $this->mobileAppCampaignFieldNames,
            'DynamicTextCampaignFieldNames' => $this->dynamicTextCampaignFieldNames,
            'DynamicTextCampaignSearchStrategyPlacementTypesFieldNames' => $this->dynamicTextCampaignSearchStrategyPlacementTypesFieldNames,
            'CpmBannerCampaignFieldNames' => $this->cpmBannerCampaignFieldNames,
            'SmartCampaignFieldNames' => $this->smartCampaignFieldNames,
            'UnifiedCampaignFieldNames' => $this->unifiedCampaignFieldNames,
            'UnifiedCampaignSearchStrategyPlacementTypesFieldNames' => $this->unifiedCampaignSearchStrategyPlacementTypesFieldNames,
            'UnifiedCampaignPackageBiddingStrategyPlatformsFieldNames' => $this->unifiedCampaignPackageBiddingStrategyPlatformsFieldNames,
            'Page' => $this->page,
        ]);
    }
} 