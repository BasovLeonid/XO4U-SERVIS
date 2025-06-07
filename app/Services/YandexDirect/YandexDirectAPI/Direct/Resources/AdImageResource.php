<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\AdImageGetRequest;
use App\Services\Yandex\Direct\DTO\AdImageAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class AdImageResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить изображения
     *
     * @param AdImageGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(AdImageGetRequest|array $request = []): Collection
    {
        if (!($request instanceof AdImageGetRequest)) {
            $request = AdImageGetRequest::fromArray($request);
        }

        $response = $this->client->request('adimages', 'get', $request->toArray());
        return collect($response['result']['AdImages'] ?? []);
    }

    /**
     * Добавить изображения
     *
     * @param AdImageAddItem|array $images Изображения для добавления
     * @return array
     */
    public function add(AdImageAddItem|array $images): array
    {
        if (!($images instanceof AdImageAddItem)) {
            $images = AdImageAddItem::fromArray($images);
        }

        $params = [
            'AdImages' => [$images->toArray()]
        ];

        $response = $this->client->request('adimages', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Удалить изображения
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора изображений
     * @return array
     */
    public function delete(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('adimages', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }
} 