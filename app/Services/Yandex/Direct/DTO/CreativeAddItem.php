<?php

namespace App\Services\Yandex\Direct\DTO;

class CreativeAddItem
{
    public function __construct(
        public readonly array $videoExtensionCreative,
    ) {}

    public static function fromArray(array $data): self
    {
        $videoExtensionCreative = array_map(
            fn(array $item) => VideoExtensionCreativeAddItem::fromArray($item),
            $data['VideoExtensionCreative']
        );

        return new self(
            videoExtensionCreative: $videoExtensionCreative,
        );
    }

    public function toArray(): array
    {
        return [
            'VideoExtensionCreative' => array_map(
                fn(VideoExtensionCreativeAddItem $item) => $item->toArray(),
                $this->videoExtensionCreative
            ),
        ];
    }
} 