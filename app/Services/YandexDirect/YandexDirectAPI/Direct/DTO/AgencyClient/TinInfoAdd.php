<?php

namespace App\Services\Yandex\Direct\DTO\AgencyClient;

class TinInfoAdd
{
    public function __construct(
        public readonly string $tinType,
        public readonly string $tin,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            tinType: $data['TinType'],
            tin: $data['Tin'],
        );
    }

    public function toArray(): array
    {
        return [
            'TinType' => $this->tinType,
            'Tin' => $this->tin,
        ];
    }
} 