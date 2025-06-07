<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\CreativeGetRequest;
use App\Services\Yandex\Direct\DTO\CreativeAddItem;
use Illuminate\Support\Collection;

class CreativeResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить креативы
     *
     * @param CreativeGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(CreativeGetRequest|array $request = []): Collection
    {
        if (!($request instanceof CreativeGetRequest)) {
            $request = CreativeGetRequest::fromArray($request);
        }

        $response = $this->client->request('creatives', 'get', $request->toArray());
        return collect($response['result']['Creatives'] ?? []);
    }

    /**
     * Добавить креативы
     *
     * @param CreativeAddItem|array $creatives Креативы для добавления
     * @return array
     */
    public function add(CreativeAddItem|array $creatives): array
    {
        if (!($creatives instanceof CreativeAddItem)) {
            $creatives = CreativeAddItem::fromArray($creatives);
        }

        $params = [
            'Creatives' => [$creatives->toArray()]
        ];

        $response = $this->client->request('creatives', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }
} 