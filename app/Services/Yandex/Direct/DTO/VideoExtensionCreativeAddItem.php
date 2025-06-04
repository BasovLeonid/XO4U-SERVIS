<?php

namespace App\Services\Yandex\Direct\DTO;

class VideoExtensionCreativeAddItem
{
    public function __construct(
        public readonly string $videoId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            videoId: $data['VideoId'],
        );
    }

    public function toArray(): array
    {
        return [
            'VideoId' => $this->videoId,
        ];
    }
} 