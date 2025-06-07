<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\DynamicFeedAdTargetGetRequest;
use App\Services\Yandex\Direct\DTO\DynamicFeedAdTargetAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class DynamicFeedAdTargetResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить условия нацеливания
     *
     * @param DynamicFeedAdTargetGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(DynamicFeedAdTargetGetRequest|array $request = []): Collection
    {
        if (!($request instanceof DynamicFeedAdTargetGetRequest)) {
            $request = DynamicFeedAdTargetGetRequest::fromArray($request);
        }

        $response = $this->client->request('dynamicfeedadtargets', 'get', $request->toArray());
        return collect($response['result']['DynamicFeedAdTargets'] ?? []);
    }

    /**
     * Добавить условия нацеливания
     *
     * @param DynamicFeedAdTargetAddItem|array $targets Условия нацеливания для добавления
     * @return array
     */
    public function add(DynamicFeedAdTargetAddItem|array $targets): array
    {
        if (!($targets instanceof DynamicFeedAdTargetAddItem)) {
            $targets = DynamicFeedAdTargetAddItem::fromArray($targets);
        }

        $params = [
            'DynamicFeedAdTargets' => [$targets->toArray()]
        ];

        $response = $this->client->request('dynamicfeedadtargets', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Удалить условия нацеливания
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора условий
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

        $response = $this->client->request('dynamicfeedadtargets', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }

    /**
     * Приостановить показ условий нацеливания
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора условий
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

        $response = $this->client->request('dynamicfeedadtargets', 'suspend', $params);
        return $response['result']['SuspendResults'] ?? [];
    }

    /**
     * Возобновить показ условий нацеливания
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора условий
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

        $response = $this->client->request('dynamicfeedadtargets', 'resume', $params);
        return $response['result']['ResumeResults'] ?? [];
    }

    /**
     * Установить ставки для условий нацеливания
     *
     * @param array $bids Массив ставок
     * @return array
     */
    public function setBids(array $bids): array
    {
        $params = [
            'Bids' => $bids
        ];

        $response = $this->client->request('dynamicfeedadtargets', 'setBids', $params);
        return $response['result']['SetBidsResults'] ?? [];
    }
} 