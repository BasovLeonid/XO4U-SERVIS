<?php

namespace App\Services\Yandex\Direct\DTO\Feed;

class UrlFeedAdd
{
    public function __construct(
        public readonly string $url,
        public readonly ?string $removeUtmTags = null,
        public readonly ?string $login = null,
        public readonly ?string $password = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['Url'],
            removeUtmTags: $data['RemoveUtmTags'] ?? null,
            login: $data['Login'] ?? null,
            password: $data['Password'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Url' => $this->url,
            'RemoveUtmTags' => $this->removeUtmTags,
            'Login' => $this->login,
            'Password' => $this->password,
        ]);
    }
} 