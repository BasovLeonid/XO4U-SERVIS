<?php

namespace App\Services\Yandex\Direct\DTO;

class TimeTargetingOnPublicHolidays
{
    public function __construct(
        public readonly string $suspendOnHolidays = 'NO',
        public readonly ?int $bidPercent = null,
        public readonly ?int $startHour = null,
        public readonly ?int $endHour = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            suspendOnHolidays: $data['SuspendOnHolidays'] ?? 'NO',
            bidPercent: $data['BidPercent'] ?? null,
            startHour: $data['StartHour'] ?? null,
            endHour: $data['EndHour'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'SuspendOnHolidays' => $this->suspendOnHolidays,
            'BidPercent' => $this->bidPercent,
            'StartHour' => $this->startHour,
            'EndHour' => $this->endHour,
        ]);
    }
} 