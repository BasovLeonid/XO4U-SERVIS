<?php

namespace App\Services\Yandex\Direct\DTO;

class AdGetRequest
{
    public function __construct(
        public readonly ?array $selectionCriteria = null,
        public readonly array $fieldNames = [],
        public readonly ?array $textAdFieldNames = null,
        public readonly ?array $mobileAppAdFieldNames = null,
        public readonly ?array $dynamicTextAdFieldNames = null,
        public readonly ?array $textImageAdFieldNames = null,
        public readonly ?array $mobileAppImageAdFieldNames = null,
        public readonly ?array $textAdBuilderAdFieldNames = null,
        public readonly ?array $mobileAppAdBuilderAdFieldNames = null,
        public readonly ?array $cpmBannerAdBuilderAdFieldNames = null,
        public readonly ?array $cpmVideoAdBuilderAdFieldNames = null,
        public readonly ?array $cpcVideoAdBuilderAdFieldNames = null,
        public readonly ?array $smartAdBuilderAdFieldNames = null,
        public readonly ?array $page = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            selectionCriteria: $data['SelectionCriteria'] ?? null,
            fieldNames: $data['FieldNames'] ?? [],
            textAdFieldNames: $data['TextAdFieldNames'] ?? null,
            mobileAppAdFieldNames: $data['MobileAppAdFieldNames'] ?? null,
            dynamicTextAdFieldNames: $data['DynamicTextAdFieldNames'] ?? null,
            textImageAdFieldNames: $data['TextImageAdFieldNames'] ?? null,
            mobileAppImageAdFieldNames: $data['MobileAppImageAdFieldNames'] ?? null,
            textAdBuilderAdFieldNames: $data['TextAdBuilderAdFieldNames'] ?? null,
            mobileAppAdBuilderAdFieldNames: $data['MobileAppAdBuilderAdFieldNames'] ?? null,
            cpmBannerAdBuilderAdFieldNames: $data['CpmBannerAdBuilderAdFieldNames'] ?? null,
            cpmVideoAdBuilderAdFieldNames: $data['CpmVideoAdBuilderAdFieldNames'] ?? null,
            cpcVideoAdBuilderAdFieldNames: $data['CpcVideoAdBuilderAdFieldNames'] ?? null,
            smartAdBuilderAdFieldNames: $data['SmartAdBuilderAdFieldNames'] ?? null,
            page: $data['Page'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'SelectionCriteria' => $this->selectionCriteria,
            'FieldNames' => $this->fieldNames,
            'TextAdFieldNames' => $this->textAdFieldNames,
            'MobileAppAdFieldNames' => $this->mobileAppAdFieldNames,
            'DynamicTextAdFieldNames' => $this->dynamicTextAdFieldNames,
            'TextImageAdFieldNames' => $this->textImageAdFieldNames,
            'MobileAppImageAdFieldNames' => $this->mobileAppImageAdFieldNames,
            'TextAdBuilderAdFieldNames' => $this->textAdBuilderAdFieldNames,
            'MobileAppAdBuilderAdFieldNames' => $this->mobileAppAdBuilderAdFieldNames,
            'CpmBannerAdBuilderAdFieldNames' => $this->cpmBannerAdBuilderAdFieldNames,
            'CpmVideoAdBuilderAdFieldNames' => $this->cpmVideoAdBuilderAdFieldNames,
            'CpcVideoAdBuilderAdFieldNames' => $this->cpcVideoAdBuilderAdFieldNames,
            'SmartAdBuilderAdFieldNames' => $this->smartAdBuilderAdFieldNames,
            'Page' => $this->page,
        ]);
    }
} 