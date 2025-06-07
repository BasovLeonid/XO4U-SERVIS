<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\BidModifierGetRequest;
use App\Services\Yandex\Direct\DTO\BidModifierAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class BidModifierResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить информацию о корректировках ставок
     *
     * @param BidModifierGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(BidModifierGetRequest|array $request = []): Collection
    {
        if (!($request instanceof BidModifierGetRequest)) {
            $request = BidModifierGetRequest::fromArray($request);
        }

        $response = $this->client->request('bidmodifiers', 'get', $request->toArray());
        return collect($response['result']['BidModifiers'] ?? []);
    }

    /**
     * Добавить корректировки ставок
     *
     * @param BidModifierAddItem|array $modifiers Корректировки для добавления
     * @return array
     */
    public function add(BidModifierAddItem|array $modifiers): array
    {
        if (!($modifiers instanceof BidModifierAddItem)) {
            $modifiers = BidModifierAddItem::fromArray($modifiers);
        }

        $params = [
            'BidModifiers' => [$modifiers->toArray()]
        ];

        $response = $this->client->request('bidmodifiers', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Обновить корректировки ставок
     *
     * @param BidModifierAddItem|array $modifiers Корректировки для обновления
     * @return array
     */
    public function set(BidModifierAddItem|array $modifiers): array
    {
        if (!($modifiers instanceof BidModifierAddItem)) {
            $modifiers = BidModifierAddItem::fromArray($modifiers);
        }

        $params = [
            'BidModifiers' => [$modifiers->toArray()]
        ];

        $response = $this->client->request('bidmodifiers', 'set', $params);
        return $response['result']['SetResults'] ?? [];
    }

    /**
     * Удалить корректировки ставок
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора корректировок
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

        $response = $this->client->request('bidmodifiers', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }

    /**
     * Включить/выключить корректировки ставок
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора корректировок
     * @return array
     */
    public function toggle(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('bidmodifiers', 'toggle', $params);
        return $response['result']['ToggleResults'] ?? [];
    }
} 