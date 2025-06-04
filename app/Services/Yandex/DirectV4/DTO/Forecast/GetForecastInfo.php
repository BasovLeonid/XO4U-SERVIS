<?php

namespace App\Services\Yandex\DirectV4\DTO\Forecast;

class GetForecastInfo
{
    public function __construct(
        public readonly array $phrases,
        public readonly ForecastCommonInfo $common,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            phrases: array_map(
                fn(array $phrase) => BannerPhraseInfo::fromArray($phrase),
                $data['Phrases']
            ),
            common: ForecastCommonInfo::fromArray($data['Common']),
        );
    }

    public function toArray(): array
    {
        return [
            'Phrases' => array_map(
                fn(BannerPhraseInfo $phrase) => $phrase->toArray(),
                $this->phrases
            ),
            'Common' => $this->common->toArray(),
        ];
    }
} 