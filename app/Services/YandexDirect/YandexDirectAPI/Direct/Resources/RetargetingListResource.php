<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\RetargetingListGetRequest;
use App\Services\Yandex\Direct\DTO\RetargetingListAddItem;
use App\Services\Yandex\Direct\DTO\RetargetingListUpdateItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class RetargetingListResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить условия ретаргетинга
     *
     * @param RetargetingListGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(RetargetingListGetRequest|array $request = []): Collection
    {
        if (!($request instanceof RetargetingListGetRequest)) {
            $request = RetargetingListGetRequest::fromArray($request);
        }

        $response = $this->client->request('retargetinglists', 'get', $request->toArray());
        return collect($response['result']['RetargetingLists'] ?? []);
    }

    /**
     * Добавить условия ретаргетинга
     *
     * @param RetargetingListAddItem|array $lists Условия ретаргетинга для добавления
     * @return array
     */
    public function add(RetargetingListAddItem|array $lists): array
    {
        if (!($lists instanceof RetargetingListAddItem)) {
            $lists = RetargetingListAddItem::fromArray($lists);
        }

        $params = [
            'RetargetingLists' => [$lists->toArray()]
        ];

        $response = $this->client->request('retargetinglists', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Обновить условия ретаргетинга
     *
     * @param RetargetingListUpdateItem|array $lists Условия ретаргетинга для обновления
     * @return array
     */
    public function update(RetargetingListUpdateItem|array $lists): array
    {
        if (!($lists instanceof RetargetingListUpdateItem)) {
            $lists = RetargetingListUpdateItem::fromArray($lists);
        }

        $params = [
            'RetargetingLists' => [$lists->toArray()]
        ];

        $response = $this->client->request('retargetinglists', 'update', $params);
        return $response['result']['UpdateResults'] ?? [];
    }

    /**
     * Удалить условия ретаргетинга
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

        $response = $this->client->request('retargetinglists', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }
} 