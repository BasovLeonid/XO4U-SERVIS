<?php

namespace App\Services\Yandex\Direct\DTO\Feed;

class FeedAddItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $businessType,
        public readonly string $sourceType,
        public readonly ?UrlFeedAdd $urlFeed = null,
        public readonly ?FileFeedAdd $fileFeed = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['Name'],
            businessType: $data['BusinessType'],
            sourceType: $data['SourceType'],
            urlFeed: isset($data['UrlFeed']) ? UrlFeedAdd::fromArray($data['UrlFeed']) : null,
            fileFeed: isset($data['FileFeed']) ? FileFeedAdd::fromArray($data['FileFeed']) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Name' => $this->name,
            'BusinessType' => $this->businessType,
            'SourceType' => $this->sourceType,
            'UrlFeed' => $this->urlFeed?->toArray(),
            'FileFeed' => $this->fileFeed?->toArray(),
        ]);
    }
} 