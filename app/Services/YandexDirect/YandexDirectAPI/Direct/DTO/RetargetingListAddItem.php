<?php

namespace App\Services\Yandex\Direct\DTO;

class RetargetingListAddItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $type,
        public readonly array $rules,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['Name'],
            description: $data['Description'],
            type: $data['Type'],
            rules: $data['Rules'],
        );
    }

    public function toArray(): array
    {
        return [
            'Name' => $this->name,
            'Description' => $this->description,
            'Type' => $this->type,
            'Rules' => $this->rules,
        ];
    }
} 