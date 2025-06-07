<?php

namespace App\Services\Yandex\DirectV4\DTO\Forecast;

class BannerPhraseInfo
{
    public function __construct(
        public readonly string $phrase,
        public readonly string $isRubric,
        public readonly float $min,
        public readonly float $max,
        public readonly float $premiumMin,
        public readonly float $premiumMax,
        public readonly int $shows,
        public readonly int $clicks,
        public readonly int $firstPlaceClicks,
        public readonly int $premiumClicks,
        public readonly float $ctr,
        public readonly float $firstPlaceCtr,
        public readonly float $premiumCtr,
        public readonly string $currency,
        public readonly ?array $auctionBids = null,
        public readonly ?array $commonMinusWords = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            phrase: $data['Phrase'],
            isRubric: $data['IsRubric'],
            min: $data['Min'],
            max: $data['Max'],
            premiumMin: $data['PremiumMin'],
            premiumMax: $data['PremiumMax'],
            shows: $data['Shows'],
            clicks: $data['Clicks'],
            firstPlaceClicks: $data['FirstPlaceClicks'],
            premiumClicks: $data['PremiumClicks'],
            ctr: $data['CTR'],
            firstPlaceCtr: $data['FirstPlaceCTR'],
            premiumCtr: $data['PremiumCTR'],
            currency: $data['Currency'],
            auctionBids: isset($data['AuctionBids']) ? array_map(
                fn(array $bid) => PhraseAuctionBids::fromArray($bid),
                $data['AuctionBids']
            ) : null,
            commonMinusWords: $data['CommonMinusWords'] ?? null,
        );
    }

    public function toArray(): array
    {
        $result = [
            'Phrase' => $this->phrase,
            'IsRubric' => $this->isRubric,
            'Min' => $this->min,
            'Max' => $this->max,
            'PremiumMin' => $this->premiumMin,
            'PremiumMax' => $this->premiumMax,
            'Shows' => $this->shows,
            'Clicks' => $this->clicks,
            'FirstPlaceClicks' => $this->firstPlaceClicks,
            'PremiumClicks' => $this->premiumClicks,
            'CTR' => $this->ctr,
            'FirstPlaceCTR' => $this->firstPlaceCtr,
            'PremiumCTR' => $this->premiumCtr,
            'Currency' => $this->currency,
        ];

        if ($this->auctionBids !== null) {
            $result['AuctionBids'] = array_map(
                fn(PhraseAuctionBids $bid) => $bid->toArray(),
                $this->auctionBids
            );
        }
        if ($this->commonMinusWords !== null) {
            $result['CommonMinusWords'] = $this->commonMinusWords;
        }

        return $result;
    }
} 