<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\AgencyClient\AgencyClientAddItem;
use App\Services\Yandex\Direct\DTO\AgencyClient\AgencyClientGetRequest;
use App\Services\Yandex\Direct\DTO\AgencyClient\AgencyClientUpdateItem;
use Illuminate\Support\Collection;

class AgencyClientResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить клиентов агентства
     *
     * @param AgencyClientGetRequest|array $request
     * @return Collection
     */
    public function get(AgencyClientGetRequest|array $request = []): Collection
    {
        if (is_array($request)) {
            $request = AgencyClientGetRequest::fromArray($request);
        }

        $response = $this->client->request('agencyclients', 'get', [
            'params' => $request->toArray()
        ]);

        return collect($response['result']['Clients'] ?? []);
    }

    /**
     * Добавить клиента агентства
     *
     * @param AgencyClientAddItem|array $client
     * @return Collection
     */
    public function add(AgencyClientAddItem|array $client): Collection
    {
        if (is_array($client)) {
            $client = AgencyClientAddItem::fromArray($client);
        }

        $response = $this->client->request('agencyclients', 'add', [
            'params' => [
                'Clients' => [$client->toArray()]
            ]
        ]);

        return collect($response['result']['AddResults'] ?? []);
    }

    /**
     * Обновить клиента агентства
     *
     * @param AgencyClientUpdateItem|array $client
     * @return Collection
     */
    public function update(AgencyClientUpdateItem|array $client): Collection
    {
        if (is_array($client)) {
            $client = AgencyClientUpdateItem::fromArray($client);
        }

        $response = $this->client->request('agencyclients', 'update', [
            'params' => [
                'Clients' => [$client->toArray()]
            ]
        ]);

        return collect($response['result']['UpdateResults'] ?? []);
    }
} 