<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\SmartAdTargetGetRequest;
use App\Services\Yandex\Direct\DTO\SmartAdTargetAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class SmartAdTargetResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить фильтры смарт-баннеров
     *
     * @param SmartAdTargetGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(SmartAdTargetGetRequest|array $request = []): Collection
    {
        if (!($request instanceof SmartAdTargetGetRequest)) {
            $request = SmartAdTargetGetRequest::fromArray($request);
        }

        $response = $this->client->request('smartadtargets', 'get', $request->toArray());
        return collect($response['result']['SmartAdTargets'] ?? []);
    }

    /**
     * Добавить фильтры смарт-баннеров
     *
     * @param SmartAdTargetAddItem|array $targets Фильтры для добавления
     * @return array
     */
    public function add(SmartAdTargetAddItem|array $targets): array
    {
        if (!($targets instanceof SmartAdTargetAddItem)) {
            $targets = SmartAdTargetAddItem::fromArray($targets);
        }

        $params = [
            'SmartAdTargets' => [$targets->toArray()]
        ];

        $response = $this->client->request('smartadtargets', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Обновить фильтры смарт-баннеров
     *
     * @param array $targets Фильтры для обновления
     * @return array
     */
    public function update(array $targets): array
    {
        $params = [
            'SmartAdTargets' => $targets
        ];

        $response = $this->client->request('smartadtargets', 'update', $params);
        return $response['result']['UpdateResults'] ?? [];
    }

    /**
     * Удалить фильтры смарт-баннеров
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора фильтров
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

        $response = $this->client->request('smartadtargets', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }

    /**
     * Приостановить показ фильтров смарт-баннеров
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора фильтров
     * @return array
     */
    public function suspend(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('smartadtargets', 'suspend', $params);
        return $response['result']['SuspendResults'] ?? [];
    }

    /**
     * Возобновить показ фильтров смарт-баннеров
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора фильтров
     * @return array
     */
    public function resume(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('smartadtargets', 'resume', $params);
        return $response['result']['ResumeResults'] ?? [];
    }

    /**
     * Установить ставки для фильтров смарт-баннеров
     *
     * @param array $bids Массив ставок
     * @return array
     */
    public function setBids(array $bids): array
    {
        $params = [
            'Bids' => $bids
        ];

        $response = $this->client->request('smartadtargets', 'setBids', $params);
        return $response['result']['SetBidsResults'] ?? [];
    }
} 