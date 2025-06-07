<?php

namespace App\Services\Yandex\Direct\DTO;

class DailyBudget
{
    public function __construct(
        public readonly int $amount,
        public readonly string $mode = 'STANDARD',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['Amount'],
            mode: $data['Mode'] ?? 'STANDARD',
        );
    }

    public function toArray(): array
    {
        return [
            'Amount' => $this->amount,
            'Mode' => $this->mode,
        ];
    }
} 