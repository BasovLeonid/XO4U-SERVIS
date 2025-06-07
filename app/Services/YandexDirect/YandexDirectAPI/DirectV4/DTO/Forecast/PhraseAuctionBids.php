<?php

namespace App\Services\Yandex\DirectV4\DTO\Forecast;

class PhraseAuctionBids
{
    public function __construct(
        public readonly string $position,
        public readonly float $bid,
        public readonly float $price,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            position: $data['Position'],
            bid: $data['Bid'],
            price: $data['Price'],
        );
    }

    public function toArray(): array
    {
        return [
            'Position' => $this->position,
            'Bid' => $this->bid,
            'Price' => $this->price,
        ];
    }
} 