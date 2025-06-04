<?php

namespace App\Services\Yandex\Direct\DTO;

class Callout
{
    public function __construct(
        public readonly string $calloutText,
    ) {
        if (mb_strlen($this->calloutText) > 25) {
            throw new \InvalidArgumentException('CalloutText must not exceed 25 characters');
        }
    }

    public static function fromArray(array $data): self
    {
        return new self(
            calloutText: $data['CalloutText'],
        );
    }

    public function toArray(): array
    {
        return [
            'CalloutText' => $this->calloutText,
        ];
    }
} 