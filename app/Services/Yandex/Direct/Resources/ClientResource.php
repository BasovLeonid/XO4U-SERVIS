<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\ClientGetRequest;
use App\Services\Yandex\Direct\DTO\ClientUpdateItem;
use Illuminate\Support\Collection;

class ClientResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить параметры рекламодателя
     *
     * @param ClientGetRequest|array $request
     * @return Collection
     */
    public function get(ClientGetRequest|array $request = []): Collection
    {
        if (is_array($request)) {
            $request = ClientGetRequest::fromArray($request);
        }

        $response = $this->client->request('clients', 'get', [
            'params' => $request->toArray()
        ]);

        return collect($response['result']['Clients'] ?? []);
    }

    /**
     * Обновить параметры рекламодателя
     *
     * @param ClientUpdateItem|array $client
     * @return Collection
     */
    public function update(ClientUpdateItem|array $client): Collection
    {
        if (is_array($client)) {
            $client = ClientUpdateItem::fromArray($client);
        }

        $response = $this->client->request('clients', 'update', [
            'params' => [
                'Clients' => [$client->toArray()]
            ]
        ]);

        return collect($response['result']['UpdateResults'] ?? []);
    }
} 