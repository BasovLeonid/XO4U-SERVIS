<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\VCardGetRequest;
use App\Services\Yandex\Direct\DTO\VCardAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class VCardResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить виртуальные визитки
     *
     * @param VCardGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(VCardGetRequest|array $request = []): Collection
    {
        if (!($request instanceof VCardGetRequest)) {
            $request = VCardGetRequest::fromArray($request);
        }

        $response = $this->client->request('vcards', 'get', $request->toArray());
        return collect($response['result']['VCards'] ?? []);
    }

    /**
     * Добавить виртуальные визитки
     *
     * @param VCardAddItem|array $vCards Визитки для добавления
     * @return array
     */
    public function add(VCardAddItem|array $vCards): array
    {
        if (!($vCards instanceof VCardAddItem)) {
            $vCards = VCardAddItem::fromArray($vCards);
        }

        $params = [
            'VCards' => [$vCards->toArray()]
        ];

        $response = $this->client->request('vcards', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Удалить виртуальные визитки
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора визиток
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

        $response = $this->client->request('vcards', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }
} 