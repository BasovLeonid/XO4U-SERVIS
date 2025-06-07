<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\AdExtensionGetRequest;
use App\Services\Yandex\Direct\DTO\AdExtensionAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class AdExtensionResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить расширения
     *
     * @param AdExtensionGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(AdExtensionGetRequest|array $request = []): Collection
    {
        if (!($request instanceof AdExtensionGetRequest)) {
            $request = AdExtensionGetRequest::fromArray($request);
        }

        $response = $this->client->request('adextensions', 'get', $request->toArray());
        return collect($response['result']['AdExtensions'] ?? []);
    }

    /**
     * Добавить расширения
     *
     * @param AdExtensionAddItem|array $extensions Расширения для добавления
     * @return array
     */
    public function add(AdExtensionAddItem|array $extensions): array
    {
        if (!($extensions instanceof AdExtensionAddItem)) {
            $extensions = AdExtensionAddItem::fromArray($extensions);
        }

        $params = [
            'AdExtensions' => [$extensions->toArray()]
        ];

        $response = $this->client->request('adextensions', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Удалить расширения
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора расширений
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

        $response = $this->client->request('adextensions', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }
} 