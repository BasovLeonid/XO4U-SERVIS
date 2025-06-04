<?php

namespace App\Services\Yandex\Direct\DTO;

class RetargetingListUpdateItem
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?array $rules = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['Id'],
            name: $data['Name'] ?? null,
            description: $data['Description'] ?? null,
            rules: $data['Rules'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Id' => $this->id,
            'Name' => $this->name,
            'Description' => $this->description,
            'Rules' => $this->rules,
        ]);
    }
} 