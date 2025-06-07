<?php

namespace App\Services\Yandex\Direct\DTO;

class TimeTargetingAdd
{
    public function __construct(
        public readonly ?array $schedule = null,
        public readonly string $considerWorkingWeekends = 'NO',
        public readonly ?array $holidaysSchedule = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            schedule: $data['Schedule'] ?? null,
            considerWorkingWeekends: $data['ConsiderWorkingWeekends'] ?? 'NO',
            holidaysSchedule: $data['HolidaysSchedule'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Schedule' => $this->schedule,
            'ConsiderWorkingWeekends' => $this->considerWorkingWeekends,
            'HolidaysSchedule' => $this->holidaysSchedule,
        ]);
    }
} 