<?php

namespace App\Services\Yandex\Direct\DTO\AgencyClient;

class EmailSubscriptionItem
{
    public function __construct(
        public readonly string $option,
        public readonly string $value,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            option: $data['Option'],
            value: $data['Value'],
        );
    }

    public function toArray(): array
    {
        return [
            'Option' => $this->option,
            'Value' => $this->value,
        ];
    }
} 