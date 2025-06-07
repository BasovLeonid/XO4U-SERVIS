<?php

namespace App\Services\Yandex\DirectV4\Resources;

use App\Services\Yandex\DirectV4\Api\Client;
use App\Services\Yandex\DirectV4\DTO\Forecast\NewForecastInfo;
use App\Services\Yandex\DirectV4\DTO\Forecast\GetForecastInfo;
use App\Services\Yandex\DirectV4\DTO\Forecast\ForecastStatusInfo;
use Illuminate\Support\Collection;

class ForecastResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Создать новый прогноз
     *
     * @param NewForecastInfo|array $forecastInfo
     * @return int ID прогноза
     */
    public function createNewForecast(NewForecastInfo|array $forecastInfo): int
    {
        if (is_array($forecastInfo)) {
            $forecastInfo = NewForecastInfo::fromArray($forecastInfo);
        }

        $response = $this->client->request('CreateNewForecast', $forecastInfo->toArray());

        return $response['data'];
    }

    /**
     * Получить прогноз по ID
     *
     * @param int $forecastId
     * @return GetForecastInfo
     */
    public function getForecast(int $forecastId): GetForecastInfo
    {
        $response = $this->client->request('GetForecast', $forecastId);

        return GetForecastInfo::fromArray($response['data']);
    }

    /**
     * Получить список прогнозов
     *
     * @return Collection<ForecastStatusInfo>
     */
    public function getForecastList(): Collection
    {
        $response = $this->client->request('GetForecastList');

        return collect($response['data'])->map(
            fn(array $item) => ForecastStatusInfo::fromArray($item)
        );
    }

    /**
     * Удалить прогноз
     *
     * @param int $forecastId ID прогноза для удаления
     * @return bool true если прогноз успешно удален
     */
    public function deleteForecastReport(int $forecastId): bool
    {
        $response = $this->client->request('DeleteForecastReport', $forecastId);

        return $response['data'] === 1;
    }
} 