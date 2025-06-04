<?php

namespace App\Services\Yandex\Direct\DTO;

class SmsSettings
{
    public function __construct(
        public readonly ?array $events = null,
        public readonly ?string $timeFrom = '09:00',
        public readonly ?string $timeTo = '21:00',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            events: $data['Events'] ?? null,
            timeFrom: $data['TimeFrom'] ?? '09:00',
            timeTo: $data['TimeTo'] ?? '21:00',
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Events' => $this->events,
            'TimeFrom' => $this->timeFrom,
            'TimeTo' => $this->timeTo,
        ]);
    }
} 