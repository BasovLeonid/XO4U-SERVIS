<?php

namespace App\Services\Yandex\Direct\DTO;

class AdImageAddItem
{
    public function __construct(
        public readonly string $imageData,
        public readonly string $name,
        public readonly ?string $type = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            imageData: $data['ImageData'],
            name: $data['Name'],
            type: $data['Type'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'ImageData' => $this->imageData,
            'Name' => $this->name,
            'Type' => $this->type,
        ]);
    }
} 