<?php

namespace App\Services\Yandex\DirectV4\Api;

use App\Services\Yandex\DirectV4\Resources\ForecastResource;

class Client
{
    public function forecasts(): ForecastResource
    {
        return new ForecastResource($this);
    }
} 