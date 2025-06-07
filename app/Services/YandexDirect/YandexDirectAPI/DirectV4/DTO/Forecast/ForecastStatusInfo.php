<?php

namespace App\Services\Yandex\DirectV4\DTO\Forecast;

class ForecastStatusInfo
{
    public const STATUS_DONE = 'Done';
    public const STATUS_PENDING = 'Pending';
    public const STATUS_FAILED = 'Failed';

    public function __construct(
        public readonly int $forecastId,
        public readonly string $statusForecast,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            forecastId: $data['ForecastID'],
            statusForecast: $data['StatusForecast'],
        );
    }

    public function toArray(): array
    {
        return [
            'ForecastID' => $this->forecastId,
            'StatusForecast' => $this->statusForecast,
        ];
    }

    public function isDone(): bool
    {
        return $this->statusForecast === self::STATUS_DONE;
    }

    public function isPending(): bool
    {
        return $this->statusForecast === self::STATUS_PENDING;
    }

    public function isFailed(): bool
    {
        return $this->statusForecast === self::STATUS_FAILED;
    }
} 