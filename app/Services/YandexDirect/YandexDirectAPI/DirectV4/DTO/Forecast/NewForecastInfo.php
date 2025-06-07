<?php

namespace App\Services\Yandex\DirectV4\DTO\Forecast;

class NewForecastInfo
{
    public function __construct(
        public readonly array $phrases,
        public readonly string $currency,
        public readonly ?array $categories = null,
        public readonly ?array $geoId = null,
        public readonly ?string $auctionBids = null,
        public readonly ?array $commonMinusWords = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            phrases: $data['Phrases'],
            currency: $data['Currency'],
            categories: $data['Categories'] ?? null,
            geoId: $data['GeoID'] ?? null,
            auctionBids: $data['AuctionBids'] ?? null,
            commonMinusWords: $data['CommonMinusWords'] ?? null,
        );
    }

    public function toArray(): array
    {
        $result = [
            'Phrases' => $this->phrases,
            'Currency' => $this->currency,
        ];

        if ($this->categories !== null) {
            $result['Categories'] = $this->categories;
        }
        if ($this->geoId !== null) {
            $result['GeoID'] = $this->geoId;
        }
        if ($this->auctionBids !== null) {
            $result['AuctionBids'] = $this->auctionBids;
        }
        if ($this->commonMinusWords !== null) {
            $result['CommonMinusWords'] = $this->commonMinusWords;
        }

        return $result;
    }
} 