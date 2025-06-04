<?php

namespace App\Services\Yandex\Direct\DTO;

class AdGroupGetRequest
{
    public function __construct(
        public readonly ?array $selectionCriteria = null,
        public readonly array $fieldNames = [],
        public readonly ?array $mobileAppAdGroupFieldNames = null,
        public readonly ?array $dynamicTextAdGroupFieldNames = null,
        public readonly ?array $cpmBannerAdGroupFieldNames = null,
        public readonly ?array $smartAdGroupFieldNames = null,
        public readonly ?array $unifiedAdGroupFieldNames = null,
        public readonly ?array $page = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            selectionCriteria: $data['SelectionCriteria'] ?? null,
            fieldNames: $data['FieldNames'] ?? [],
            mobileAppAdGroupFieldNames: $data['MobileAppAdGroupFieldNames'] ?? null,
            dynamicTextAdGroupFieldNames: $data['DynamicTextAdGroupFieldNames'] ?? null,
            cpmBannerAdGroupFieldNames: $data['CpmBannerAdGroupFieldNames'] ?? null,
            smartAdGroupFieldNames: $data['SmartAdGroupFieldNames'] ?? null,
            unifiedAdGroupFieldNames: $data['UnifiedAdGroupFieldNames'] ?? null,
            page: $data['Page'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'SelectionCriteria' => $this->selectionCriteria,
            'FieldNames' => $this->fieldNames,
            'MobileAppAdGroupFieldNames' => $this->mobileAppAdGroupFieldNames,
            'DynamicTextAdGroupFieldNames' => $this->dynamicTextAdGroupFieldNames,
            'CpmBannerAdGroupFieldNames' => $this->cpmBannerAdGroupFieldNames,
            'SmartAdGroupFieldNames' => $this->smartAdGroupFieldNames,
            'UnifiedAdGroupFieldNames' => $this->unifiedAdGroupFieldNames,
            'Page' => $this->page,
        ]);
    }
} 