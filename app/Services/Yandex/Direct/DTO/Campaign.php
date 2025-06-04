<?php

namespace App\Services\Yandex\Direct\DTO;

class Campaign
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $clientInfo = null,
        public readonly ?string $startDate = null,
        public readonly ?string $endDate = null,
        public readonly ?string $timeZone = null,
        public readonly ?string $status = null,
        public readonly ?string $state = null,
        public readonly ?string $statusPayment = null,
        public readonly ?string $statusClarification = null,
        public readonly ?float $dailyBudget = null,
        public readonly ?float $sharedAccountBudget = null,
        public readonly ?string $type = null,
        public readonly ?array $settings = null,
        public readonly ?array $attributionModel = null,
        public readonly ?array $trackingParams = null,
        public readonly ?array $mobileAppCampaign = null,
        public readonly ?array $dynamicTextCampaign = null,
        public readonly ?array $cpmBannerCampaign = null,
        public readonly ?array $smartCampaign = null,
        public readonly ?array $textCampaign = null,
        public readonly ?array $mobileAppCampaignSettings = null,
        public readonly ?array $dynamicTextCampaignSettings = null,
        public readonly ?array $cpmBannerCampaignSettings = null,
        public readonly ?array $smartCampaignSettings = null,
        public readonly ?array $textCampaignSettings = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['Id'] ?? null,
            name: $data['Name'] ?? null,
            clientInfo: $data['ClientInfo'] ?? null,
            startDate: $data['StartDate'] ?? null,
            endDate: $data['EndDate'] ?? null,
            timeZone: $data['TimeZone'] ?? null,
            status: $data['Status'] ?? null,
            state: $data['State'] ?? null,
            statusPayment: $data['StatusPayment'] ?? null,
            statusClarification: $data['StatusClarification'] ?? null,
            dailyBudget: $data['DailyBudget'] ?? null,
            sharedAccountBudget: $data['SharedAccountBudget'] ?? null,
            type: $data['Type'] ?? null,
            settings: $data['Settings'] ?? null,
            attributionModel: $data['AttributionModel'] ?? null,
            trackingParams: $data['TrackingParams'] ?? null,
            mobileAppCampaign: $data['MobileAppCampaign'] ?? null,
            dynamicTextCampaign: $data['DynamicTextCampaign'] ?? null,
            cpmBannerCampaign: $data['CpmBannerCampaign'] ?? null,
            smartCampaign: $data['SmartCampaign'] ?? null,
            textCampaign: $data['TextCampaign'] ?? null,
            mobileAppCampaignSettings: $data['MobileAppCampaignSettings'] ?? null,
            dynamicTextCampaignSettings: $data['DynamicTextCampaignSettings'] ?? null,
            cpmBannerCampaignSettings: $data['CpmBannerCampaignSettings'] ?? null,
            smartCampaignSettings: $data['SmartCampaignSettings'] ?? null,
            textCampaignSettings: $data['TextCampaignSettings'] ?? null,
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
            'TimeZone' => $this->timeZone,
            'Status' => $this->status,
            'State' => $this->state,
            'StatusPayment' => $this->statusPayment,
            'StatusClarification' => $this->statusClarification,
            'DailyBudget' => $this->dailyBudget,
            'SharedAccountBudget' => $this->sharedAccountBudget,
            'Type' => $this->type,
            'Settings' => $this->settings,
            'AttributionModel' => $this->attributionModel,
            'TrackingParams' => $this->trackingParams,
            'MobileAppCampaign' => $this->mobileAppCampaign,
            'DynamicTextCampaign' => $this->dynamicTextCampaign,
            'CpmBannerCampaign' => $this->cpmBannerCampaign,
            'SmartCampaign' => $this->smartCampaign,
            'TextCampaign' => $this->textCampaign,
            'MobileAppCampaignSettings' => $this->mobileAppCampaignSettings,
            'DynamicTextCampaignSettings' => $this->dynamicTextCampaignSettings,
            'CpmBannerCampaignSettings' => $this->cpmBannerCampaignSettings,
            'SmartCampaignSettings' => $this->smartCampaignSettings,
            'TextCampaignSettings' => $this->textCampaignSettings,
        ]);
    }
} 