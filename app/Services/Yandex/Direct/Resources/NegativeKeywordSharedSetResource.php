<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\NegativeKeywordSharedSetGetRequest;
use App\Services\Yandex\Direct\DTO\NegativeKeywordSharedSetAddItem;
use App\Services\Yandex\Direct\DTO\NegativeKeywordSharedSetUpdateItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class NegativeKeywordSharedSetResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить информацию о наборах минус-фраз
     *
     * @param NegativeKeywordSharedSetGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(NegativeKeywordSharedSetGetRequest|array $request = []): Collection
    {
        if (!($request instanceof NegativeKeywordSharedSetGetRequest)) {
            $request = NegativeKeywordSharedSetGetRequest::fromArray($request);
        }

        $response = $this->client->request('negativekeywordsharedsets', 'get', $request->toArray());
        return collect($response['result']['NegativeKeywordSharedSets'] ?? []);
    }

    /**
     * Добавить наборы минус-фраз
     *
     * @param NegativeKeywordSharedSetAddItem|array $sets Наборы для добавления
     * @return array
     */
    public function add(NegativeKeywordSharedSetAddItem|array $sets): array
    {
        if (!($sets instanceof NegativeKeywordSharedSetAddItem)) {
            $sets = NegativeKeywordSharedSetAddItem::fromArray($sets);
        }

        $params = [
            'NegativeKeywordSharedSets' => [$sets->toArray()]
        ];

        $response = $this->client->request('negativekeywordsharedsets', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Обновить наборы минус-фраз
     *
     * @param NegativeKeywordSharedSetUpdateItem|array $sets Наборы для обновления
     * @return array
     */
    public function update(NegativeKeywordSharedSetUpdateItem|array $sets): array
    {
        if (!($sets instanceof NegativeKeywordSharedSetUpdateItem)) {
            $sets = NegativeKeywordSharedSetUpdateItem::fromArray($sets);
        }

        $params = [
            'NegativeKeywordSharedSets' => [$sets->toArray()]
        ];

        $response = $this->client->request('negativekeywordsharedsets', 'update', $params);
        return $response['result']['UpdateResults'] ?? [];
    }

    /**
     * Удалить наборы минус-фраз
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора наборов
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

        $response = $this->client->request('negativekeywordsharedsets', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }
} 