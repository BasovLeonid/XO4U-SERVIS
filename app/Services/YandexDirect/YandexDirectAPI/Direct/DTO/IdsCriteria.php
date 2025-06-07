<?php

namespace App\Services\Yandex\Direct\DTO;

class IdsCriteria
{
    public function __construct(
        public readonly array $ids,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            ids: $data['Ids'],
        );
    }

    public function toArray(): array
    {
        return [
            'Ids' => $this->ids,
        ];
    }
} 