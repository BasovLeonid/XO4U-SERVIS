<?php

namespace App\Services\Yandex\Direct\DTO\AgencyClient;

class GrantItem
{
    public function __construct(
        public readonly string $privilege,
        public readonly string $value,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            privilege: $data['Privilege'],
            value: $data['Value'],
        );
    }

    public function toArray(): array
    {
        return [
            'Privilege' => $this->privilege,
            'Value' => $this->value,
        ];
    }
} 