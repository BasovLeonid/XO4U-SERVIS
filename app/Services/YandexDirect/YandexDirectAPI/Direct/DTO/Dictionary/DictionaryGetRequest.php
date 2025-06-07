<?php

namespace App\Services\Yandex\Direct\DTO\Dictionary;

class DictionaryGetRequest
{
    public function __construct(
        public readonly array $dictionaryNames,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            dictionaryNames: $data['DictionaryNames'],
        );
    }

    public function toArray(): array
    {
        return [
            'DictionaryNames' => $this->dictionaryNames,
        ];
    }
} 