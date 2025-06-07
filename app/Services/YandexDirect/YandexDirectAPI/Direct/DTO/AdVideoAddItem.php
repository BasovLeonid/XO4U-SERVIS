<?php

namespace App\Services\Yandex\Direct\DTO;

class AdVideoAddItem
{
    public function __construct(
        public readonly ?string $url = null,
        public readonly ?string $videoData = null,
        public readonly ?string $name = null,
    ) {
        if ($this->url === null && ($this->videoData === null || $this->name === null)) {
            throw new \InvalidArgumentException('Either URL or both VideoData and Name must be provided');
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['URL'] ?? null,
            videoData: $data['VideoData'] ?? null,
            name: $data['Name'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'URL' => $this->url,
            'VideoData' => $this->videoData,
            'Name' => $this->name,
        ]);
    }
} 