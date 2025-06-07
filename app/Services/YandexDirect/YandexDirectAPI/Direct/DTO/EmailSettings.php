<?php

namespace App\Services\Yandex\Direct\DTO;

class EmailSettings
{
    public function __construct(
        public readonly ?string $email = null,
        public readonly ?int $checkPositionInterval = 60,
        public readonly ?int $warningBalance = 20,
        public readonly ?string $sendAccountNews = 'NO',
        public readonly ?string $sendWarnings = 'NO',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['Email'] ?? null,
            checkPositionInterval: $data['CheckPositionInterval'] ?? 60,
            warningBalance: $data['WarningBalance'] ?? 20,
            sendAccountNews: $data['SendAccountNews'] ?? 'NO',
            sendWarnings: $data['SendWarnings'] ?? 'NO',
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Email' => $this->email,
            'CheckPositionInterval' => $this->checkPositionInterval,
            'WarningBalance' => $this->warningBalance,
            'SendAccountNews' => $this->sendAccountNews,
            'SendWarnings' => $this->sendWarnings,
        ]);
    }
} 