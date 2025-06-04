<?php

namespace App\Services\Yandex\Direct\DTO;

class BidModifierAddItem
{
    public function __construct(
        public readonly int $campaignId,
        public readonly string $type,
        public readonly array $level,
        public readonly array $adjustment,
        public readonly ?array $retargetingListId = null,
        public readonly ?array $interestId = null,
        public readonly ?array $demographics = null,
        public readonly ?array $deviceType = null,
        public readonly ?array $mobileOperatingSystemType = null,
        public readonly ?array $mobileAppCategory = null,
        public readonly ?array $mobileApp = null,
        public readonly ?array $gender = null,
        public readonly ?array $age = null,
        public readonly ?array $videoAdjustment = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            campaignId: $data['CampaignId'],
            type: $data['Type'],
            level: $data['Level'],
            adjustment: $data['Adjustment'],
            retargetingListId: $data['RetargetingListId'] ?? null,
            interestId: $data['InterestId'] ?? null,
            demographics: $data['Demographics'] ?? null,
            deviceType: $data['DeviceType'] ?? null,
            mobileOperatingSystemType: $data['MobileOperatingSystemType'] ?? null,
            mobileAppCategory: $data['MobileAppCategory'] ?? null,
            mobileApp: $data['MobileApp'] ?? null,
            gender: $data['Gender'] ?? null,
            age: $data['Age'] ?? null,
            videoAdjustment: $data['VideoAdjustment'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'CampaignId' => $this->campaignId,
            'Type' => $this->type,
            'Level' => $this->level,
            'Adjustment' => $this->adjustment,
            'RetargetingListId' => $this->retargetingListId,
            'InterestId' => $this->interestId,
            'Demographics' => $this->demographics,
            'DeviceType' => $this->deviceType,
            'MobileOperatingSystemType' => $this->mobileOperatingSystemType,
            'MobileAppCategory' => $this->mobileAppCategory,
            'MobileApp' => $this->mobileApp,
            'Gender' => $this->gender,
            'Age' => $this->age,
            'VideoAdjustment' => $this->videoAdjustment,
        ]);
    }
} 