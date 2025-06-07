<?php

namespace App\Services\Yandex\Direct\DTO;

class ClientUpdateItem
{
    public function __construct(
        public readonly ?string $login = null,
        public readonly ?array $settings = null,
        public readonly ?array $restrictions = null,
        public readonly ?array $grants = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            login: $data['Login'] ?? null,
            settings: $data['Settings'] ?? null,
            restrictions: $data['Restrictions'] ?? null,
            grants: $data['Grants'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Login' => $this->login,
            'Settings' => $this->settings,
            'Restrictions' => $this->restrictions,
            'Grants' => $this->grants,
        ]);
    }
} 