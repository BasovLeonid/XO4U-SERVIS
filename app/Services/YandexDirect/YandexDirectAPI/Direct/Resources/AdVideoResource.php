<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\AdVideoGetRequest;
use App\Services\Yandex\Direct\DTO\AdVideoAddItem;
use Illuminate\Support\Collection;

class AdVideoResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить видео
     *
     * @param AdVideoGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(AdVideoGetRequest|array $request = []): Collection
    {
        if (!($request instanceof AdVideoGetRequest)) {
            $request = AdVideoGetRequest::fromArray($request);
        }

        $response = $this->client->request('advideos', 'get', $request->toArray());
        return collect($response['result']['AdVideos'] ?? []);
    }

    /**
     * Добавить видео
     *
     * @param AdVideoAddItem|array $videos Видео для добавления
     * @return array
     */
    public function add(AdVideoAddItem|array $videos): array
    {
        if (!($videos instanceof AdVideoAddItem)) {
            $videos = AdVideoAddItem::fromArray($videos);
        }

        $params = [
            'AdVideos' => [$videos->toArray()]
        ];

        $response = $this->client->request('advideos', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }
} 