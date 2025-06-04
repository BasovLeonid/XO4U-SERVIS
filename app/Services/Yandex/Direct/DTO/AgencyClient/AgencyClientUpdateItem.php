<?php

namespace App\Services\Yandex\Direct\DTO\AgencyClient;

class AgencyClientUpdateItem
{
    public function __construct(
        public readonly string $login,
        public readonly ?array $grants = null,
        public readonly ?array $settings = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            login: $data['Login'],
            grants: isset($data['Grants']) ? array_map(
                fn(array $item) => GrantItem::fromArray($item),
                $data['Grants']
            ) : null,
            settings: isset($data['Settings']) ? array_map(
                fn(array $item) => ClientSettingAddItem::fromArray($item),
                $data['Settings']
            ) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Login' => $this->login,
            'Grants' => $this->grants ? array_map(
                fn(GrantItem $item) => $item->toArray(),
                $this->grants
            ) : null,
            'Settings' => $this->settings ? array_map(
                fn(ClientSettingAddItem $item) => $item->toArray(),
                $this->settings
            ) : null,
        ]);
    }
} 