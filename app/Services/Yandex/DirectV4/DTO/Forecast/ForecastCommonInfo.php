<?php

namespace App\Services\Yandex\DirectV4\DTO\Forecast;

class ForecastCommonInfo
{
    public function __construct(
        public readonly string $geo,
        public readonly float $min,
        public readonly float $max,
        public readonly float $premiumMin,
        public readonly int $shows,
        public readonly int $clicks,
        public readonly int $firstPlaceClicks,
        public readonly int $premiumClicks,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            geo: $data['Geo'],
            min: $data['Min'],
            max: $data['Max'],
            premiumMin: $data['PremiumMin'],
            shows: $data['Shows'],
            clicks: $data['Clicks'],
            firstPlaceClicks: $data['FirstPlaceClicks'],
            premiumClicks: $data['PremiumClicks'],
        );
    }

    public function toArray(): array
    {
        return [
            'Geo' => $this->geo,
            'Min' => $this->min,
            'Max' => $this->max,
            'PremiumMin' => $this->premiumMin,
            'Shows' => $this->shows,
            'Clicks' => $this->clicks,
            'FirstPlaceClicks' => $this->firstPlaceClicks,
            'PremiumClicks' => $this->premiumClicks,
        ];
    }
} 