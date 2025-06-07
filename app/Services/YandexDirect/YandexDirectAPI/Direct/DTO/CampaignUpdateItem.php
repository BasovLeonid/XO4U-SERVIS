<?php

namespace App\Services\Yandex\Direct\DTO;

class CampaignUpdateItem
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?string $clientInfo = null,
        public readonly ?string $startDate = null,
        public readonly ?string $endDate = null,
        public readonly ?array $timeTargeting = null,
        public readonly ?string $timeZone = null,
        public readonly ?array $negativeKeywords = null,
        public readonly ?array $blockedIps = null,
        public readonly ?array $excludedSites = null,
        public readonly ?array $dailyBudget = null,
        public readonly ?array $notification = null,
        public readonly ?array $textCampaign = null,
        public readonly ?array $mobileAppCampaign = null,
        public readonly ?array $dynamicTextCampaign = null,
        public readonly ?array $cpmBannerCampaign = null,
        public readonly ?array $smartCampaign = null,
        public readonly ?array $unifiedCampaign = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'] ?? null,
            clientInfo: $data['ClientInfo'] ?? null,
            startDate: $data['StartDate'] ?? null,
            endDate: $data['EndDate'] ?? null,
            timeTargeting: $data['TimeTargeting'] ?? null,
            timeZone: $data['TimeZone'] ?? null,
            negativeKeywords: $data['NegativeKeywords'] ?? null,
            blockedIps: $data['BlockedIps'] ?? null,
            excludedSites: $data['ExcludedSites'] ?? null,
            dailyBudget: $data['DailyBudget'] ?? null,
            notification: $data['Notification'] ?? null,
            textCampaign: $data['TextCampaign'] ?? null,
            mobileAppCampaign: $data['MobileAppCampaign'] ?? null,
            dynamicTextCampaign: $data['DynamicTextCampaign'] ?? null,
            cpmBannerCampaign: $data['CpmBannerCampaign'] ?? null,
            smartCampaign: $data['SmartCampaign'] ?? null,
            unifiedCampaign: $data['UnifiedCampaign'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Id' => $this->id,
            'Name' => $this->name,
            'ClientInfo' => $this->clientInfo,
            'StartDate' => $this->startDate,
            'EndDate' => $this->endDate,
            'TimeTargeting' => $this->timeTargeting,
            'TimeZone' => $this->timeZone,
            'NegativeKeywords' => $this->negativeKeywords,
            'BlockedIps' => $this->blockedIps,
            'ExcludedSites' => $this->excludedSites,
            'DailyBudget' => $this->dailyBudget,
            'Notification' => $this->notification,
            'TextCampaign' => $this->textCampaign,
            'MobileAppCampaign' => $this->mobileAppCampaign,
            'DynamicTextCampaign' => $this->dynamicTextCampaign,
            'CpmBannerCampaign' => $this->cpmBannerCampaign,
            'SmartCampaign' => $this->smartCampaign,
            'UnifiedCampaign' => $this->unifiedCampaign,
        ]);
    }
} 