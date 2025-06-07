<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\AdGetRequest;
use App\Services\Yandex\Direct\DTO\AdAddItem;
use App\Services\Yandex\Direct\DTO\AdUpdateItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class AdResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить список объявлений
     *
     * @param AdGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(AdGetRequest|array $request = []): Collection
    {
        if (!($request instanceof AdGetRequest)) {
            $request = AdGetRequest::fromArray($request);
        }

        $response = $this->client->request('ads', 'get', $request->toArray());
        return collect($response['result']['Ads'] ?? []);
    }

    /**
     * Создать новые объявления
     *
     * @param AdAddItem|array $ads Объявления для создания
     * @return array
     */
    public function add(AdAddItem|array $ads): array
    {
        if (!($ads instanceof AdAddItem)) {
            $ads = AdAddItem::fromArray($ads);
        }

        $params = [
            'Ads' => [$ads->toArray()]
        ];

        $response = $this->client->request('ads', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Обновить существующие объявления
     *
     * @param AdUpdateItem|array $ads Объявления для обновления
     * @return array
     */
    public function update(AdUpdateItem|array $ads): array
    {
        if (!($ads instanceof AdUpdateItem)) {
            $ads = AdUpdateItem::fromArray($ads);
        }

        $params = [
            'Ads' => [$ads->toArray()]
        ];

        $response = $this->client->request('ads', 'update', $params);
        return $response['result']['UpdateResults'] ?? [];
    }

    /**
     * Удалить объявления
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора объявлений
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

        $response = $this->client->request('ads', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }

    /**
     * Приостановить показ объявлений
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора объявлений
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

        $response = $this->client->request('ads', 'suspend', $params);
        return $response['result']['SuspendResults'] ?? [];
    }

    /**
     * Возобновить показ объявлений
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора объявлений
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

        $response = $this->client->request('ads', 'resume', $params);
        return $response['result']['ResumeResults'] ?? [];
    }

    /**
     * Архивировать объявления
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора объявлений
     * @return array
     */
    public function archive(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('ads', 'archive', $params);
        return $response['result']['ArchiveResults'] ?? [];
    }

    /**
     * Разархивировать объявления
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора объявлений
     * @return array
     */
    public function unarchive(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('ads', 'unarchive', $params);
        return $response['result']['UnarchiveResults'] ?? [];
    }

    /**
     * Отправить объявления на модерацию
     *
     * @param IdsCriteria|array $selectionCriteria Критерии выбора объявлений
     * @return array
     */
    public function moderate(IdsCriteria|array $selectionCriteria): array
    {
        if (!($selectionCriteria instanceof IdsCriteria)) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('ads', 'moderate', $params);
        return $response['result']['ModerateResults'] ?? [];
    }
} 