<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\AdGroupGetRequest;
use App\Services\Yandex\Direct\DTO\AdGroupAddItem;
use App\Services\Yandex\Direct\DTO\AdGroupUpdateItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use App\Services\Yandex\Direct\Exceptions\ApiException;
use Illuminate\Support\Collection;

class AdGroupResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить список групп объявлений
     *
     * @param AdGroupGetRequest|array $request Параметры запроса
     * @return Collection
     * @throws ApiException
     */
    public function get(AdGroupGetRequest|array $request = []): Collection
    {
        if (!($request instanceof AdGroupGetRequest)) {
            $request = AdGroupGetRequest::fromArray($request);
        }

        $response = $this->client->request('adgroups', 'get', $request->toArray());
        return collect($response['result']['AdGroups'] ?? []);
    }

    /**
     * Создать новые группы объявлений
     *
     * @param AdGroupAddItem|array $adGroups Группы объявлений для создания
     * @return array
     * @throws ApiException
     */
    public function add(AdGroupAddItem|array $adGroups): array
    {
        if (!($adGroups instanceof AdGroupAddItem)) {
            $adGroups = AdGroupAddItem::fromArray($adGroups);
        }

        $params = [
            'AdGroups' => [$adGroups->toArray()]
        ];

        $response = $this->client->request('adgroups', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Обновить существующие группы объявлений
     *
     * @param AdGroupUpdateItem|array $adGroups Группы объявлений для обновления
     * @return array
     * @throws ApiException
     */
    public function update(AdGroupUpdateItem|array $adGroups): array
    {
        if (!($adGroups instanceof AdGroupUpdateItem)) {
            $adGroups = AdGroupUpdateItem::fromArray($adGroups);
        }

        $params = [
            'AdGroups' => [$adGroups->toArray()]
        ];

        $response = $this->client->request('adgroups', 'update', $params);
        return $response['result']['UpdateResults'] ?? [];
    }

    /**
     * Удалить группы объявлений
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора групп объявлений
     * @return array
     * @throws ApiException
     */
    public function delete(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('adgroups', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }
} 