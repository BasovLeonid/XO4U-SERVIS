<?php

namespace App\Services\Yandex\Direct\DTO;

class AdExtensionAddItem
{
    public function __construct(
        public readonly ?Callout $callout = null,
    ) {}

    public static function fromArray(array $data): self
    {
        $callout = isset($data['Callout']) ? Callout::fromArray($data['Callout']) : null;

        return new self(
            callout: $callout,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Callout' => $this->callout?->toArray(),
        ]);
    }
} 