<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\KeywordGetRequest;
use App\Services\Yandex\Direct\DTO\KeywordAddItem;
use App\Services\Yandex\Direct\DTO\KeywordUpdateItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class KeywordResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить список ключевых фраз
     *
     * @param KeywordGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(KeywordGetRequest|array $request = []): Collection
    {
        if (!($request instanceof KeywordGetRequest)) {
            $request = KeywordGetRequest::fromArray($request);
        }

        $response = $this->client->request('keywords', 'get', $request->toArray());
        return collect($response['result']['Keywords'] ?? []);
    }

    /**
     * Создать новые ключевые фразы
     *
     * @param KeywordAddItem|array $keywords Ключевые фразы для создания
     * @return array
     */
    public function add(KeywordAddItem|array $keywords): array
    {
        if (!($keywords instanceof KeywordAddItem)) {
            $keywords = KeywordAddItem::fromArray($keywords);
        }

        $params = [
            'Keywords' => [$keywords->toArray()]
        ];

        $response = $this->client->request('keywords', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Обновить существующие ключевые фразы
     *
     * @param KeywordUpdateItem|array $keywords Ключевые фразы для обновления
     * @return array
     */
    public function update(KeywordUpdateItem|array $keywords): array
    {
        if (!($keywords instanceof KeywordUpdateItem)) {
            $keywords = KeywordUpdateItem::fromArray($keywords);
        }

        $params = [
            'Keywords' => [$keywords->toArray()]
        ];

        $response = $this->client->request('keywords', 'update', $params);
        return $response['result']['UpdateResults'] ?? [];
    }

    /**
     * Удалить ключевые фразы
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора ключевых фраз
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

        $response = $this->client->request('keywords', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }

    /**
     * Приостановить показ ключевых фраз
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора ключевых фраз
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

        $response = $this->client->request('keywords', 'suspend', $params);
        return $response['result']['SuspendResults'] ?? [];
    }

    /**
     * Возобновить показ ключевых фраз
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора ключевых фраз
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

        $response = $this->client->request('keywords', 'resume', $params);
        return $response['result']['ResumeResults'] ?? [];
    }
} 