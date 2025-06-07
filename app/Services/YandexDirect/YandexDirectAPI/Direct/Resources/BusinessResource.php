<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\BusinessGetRequest;
use Illuminate\Support\Collection;

class BusinessResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить профили организаций
     *
     * @param BusinessGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(BusinessGetRequest|array $request = []): Collection
    {
        if (!($request instanceof BusinessGetRequest)) {
            $request = BusinessGetRequest::fromArray($request);
        }

        $response = $this->client->request('businesses', 'get', $request->toArray());
        return collect($response['result']['Businesses'] ?? []);
    }
} 