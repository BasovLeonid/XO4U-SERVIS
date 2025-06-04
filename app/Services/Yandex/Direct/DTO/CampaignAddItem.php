<?php

namespace App\Services\Yandex\Direct\DTO;

class CampaignAddItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $startDate,
        public readonly ?string $clientInfo = null,
        public readonly ?string $timeZone = 'Europe/Moscow',
        public readonly ?string $endDate = null,
        public readonly ?array $notification = null,
        public readonly ?array $dailyBudget = null,
        public readonly ?array $negativeKeywords = null,
        public readonly ?array $blockedIps = null,
        public readonly ?array $excludedSites = null,
        public readonly ?array $textCampaign = null,
        public readonly ?array $mobileAppCampaign = null,
        public readonly ?array $dynamicTextCampaign = null,
        public readonly ?array $cpmBannerCampaign = null,
        public readonly ?array $smartCampaign = null,
        public readonly ?array $unifiedCampaign = null,
        public readonly ?array $timeTargeting = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['Name'],
            startDate: $data['StartDate'],
            clientInfo: $data['ClientInfo'] ?? null,
            timeZone: $data['TimeZone'] ?? 'Europe/Moscow',
            endDate: $data['EndDate'] ?? null,
            notification: $data['Notification'] ?? null,
            dailyBudget: $data['DailyBudget'] ?? null,
            negativeKeywords: $data['NegativeKeywords'] ?? null,
            blockedIps: $data['BlockedIps'] ?? null,
            excludedSites: $data['ExcludedSites'] ?? null,
            textCampaign: $data['TextCampaign'] ?? null,
            mobileAppCampaign: $data['MobileAppCampaign'] ?? null,
            dynamicTextCampaign: $data['DynamicTextCampaign'] ?? null,
            cpmBannerCampaign: $data['CpmBannerCampaign'] ?? null,
            smartCampaign: $data['SmartCampaign'] ?? null,
            unifiedCampaign: $data['UnifiedCampaign'] ?? null,
            timeTargeting: $data['TimeTargeting'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Name' => $this->name,
            'StartDate' => $this->startDate,
            'ClientInfo' => $this->clientInfo,
            'TimeZone' => $this->timeZone,
            'EndDate' => $this->endDate,
            'Notification' => $this->notification,
            'DailyBudget' => $this->dailyBudget,
            'NegativeKeywords' => $this->negativeKeywords,
            'BlockedIps' => $this->blockedIps,
            'ExcludedSites' => $this->excludedSites,
            'TextCampaign' => $this->textCampaign,
            'MobileAppCampaign' => $this->mobileAppCampaign,
            'DynamicTextCampaign' => $this->dynamicTextCampaign,
            'CpmBannerCampaign' => $this->cpmBannerCampaign,
            'SmartCampaign' => $this->smartCampaign,
            'UnifiedCampaign' => $this->unifiedCampaign,
            'TimeTargeting' => $this->timeTargeting,
        ]);
    }
} 