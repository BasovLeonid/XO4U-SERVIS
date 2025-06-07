<?php

namespace App\Services\Yandex\Direct\DTO;

class Sitelink
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $href = null,
        public readonly ?int $turboPageId = null,
        public readonly ?string $description = null,
    ) {
        if ($this->href === null && $this->turboPageId === null) {
            throw new \InvalidArgumentException('Either Href or TurboPageId must be provided');
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['Title'],
            href: $data['Href'] ?? null,
            turboPageId: $data['TurboPageId'] ?? null,
            description: $data['Description'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Title' => $this->title,
            'Href' => $this->href,
            'TurboPageId' => $this->turboPageId,
            'Description' => $this->description,
        ]);
    }
} 