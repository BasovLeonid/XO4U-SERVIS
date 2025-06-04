<?php

namespace App\Services\Yandex\Direct\DTO;

class AdAddItem
{
    public function __construct(
        public readonly int $adGroupId,
        public readonly ?array $textAd = null,
        public readonly ?array $mobileAppAd = null,
        public readonly ?array $dynamicTextAd = null,
        public readonly ?array $textImageAd = null,
        public readonly ?array $mobileAppImageAd = null,
        public readonly ?array $textAdBuilderAd = null,
        public readonly ?array $mobileAppAdBuilderAd = null,
        public readonly ?array $cpmBannerAdBuilderAd = null,
        public readonly ?array $cpmVideoAdBuilderAd = null,
        public readonly ?array $cpcVideoAdBuilderAd = null,
        public readonly ?array $smartAdBuilderAd = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            adGroupId: $data['AdGroupId'],
            textAd: $data['TextAd'] ?? null,
            mobileAppAd: $data['MobileAppAd'] ?? null,
            dynamicTextAd: $data['DynamicTextAd'] ?? null,
            textImageAd: $data['TextImageAd'] ?? null,
            mobileAppImageAd: $data['MobileAppImageAd'] ?? null,
            textAdBuilderAd: $data['TextAdBuilderAd'] ?? null,
            mobileAppAdBuilderAd: $data['MobileAppAdBuilderAd'] ?? null,
            cpmBannerAdBuilderAd: $data['CpmBannerAdBuilderAd'] ?? null,
            cpmVideoAdBuilderAd: $data['CpmVideoAdBuilderAd'] ?? null,
            cpcVideoAdBuilderAd: $data['CpcVideoAdBuilderAd'] ?? null,
            smartAdBuilderAd: $data['SmartAdBuilderAd'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'AdGroupId' => $this->adGroupId,
            'TextAd' => $this->textAd,
            'MobileAppAd' => $this->mobileAppAd,
            'DynamicTextAd' => $this->dynamicTextAd,
            'TextImageAd' => $this->textImageAd,
            'MobileAppImageAd' => $this->mobileAppImageAd,
            'TextAdBuilderAd' => $this->textAdBuilderAd,
            'MobileAppAdBuilderAd' => $this->mobileAppAdBuilderAd,
            'CpmBannerAdBuilderAd' => $this->cpmBannerAdBuilderAd,
            'CpmVideoAdBuilderAd' => $this->cpmVideoAdBuilderAd,
            'CpcVideoAdBuilderAd' => $this->cpcVideoAdBuilderAd,
            'SmartAdBuilderAd' => $this->smartAdBuilderAd,
        ]);
    }
} 