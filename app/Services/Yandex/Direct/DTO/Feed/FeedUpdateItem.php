<?php

namespace App\Services\Yandex\Direct\DTO\Feed;

class FeedUpdateItem
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?UrlFeedAdd $urlFeed = null,
        public readonly ?FileFeedAdd $fileFeed = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'] ?? null,
            urlFeed: isset($data['UrlFeed']) ? UrlFeedAdd::fromArray($data['UrlFeed']) : null,
            fileFeed: isset($data['FileFeed']) ? FileFeedAdd::fromArray($data['FileFeed']) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Id' => $this->id,
            'Name' => $this->name,
            'UrlFeed' => $this->urlFeed?->toArray(),
            'FileFeed' => $this->fileFeed?->toArray(),
        ]);
    }
} 