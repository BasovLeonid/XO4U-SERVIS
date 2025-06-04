<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\Campaign;
use App\Services\Yandex\Direct\DTO\CampaignAddItem;
use App\Services\Yandex\Direct\DTO\CampaignUpdateItem;
use App\Services\Yandex\Direct\Enums\CampaignStatus;
use App\Services\Yandex\Direct\Enums\CampaignType;
use App\Services\Yandex\Direct\Exceptions\ApiException;
use Illuminate\Support\Collection;
use App\Services\Yandex\Direct\DTO\CampaignGetRequest;
use App\Services\Yandex\Direct\DTO\IdsCriteria;

class CampaignResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить список кампаний
     *
     * @param CampaignGetRequest|array $request Параметры запроса
     * @return Collection<Campaign>
     * @throws ApiException
     */
    public function get(CampaignGetRequest|array $request): Collection
    {
        if (!$request instanceof CampaignGetRequest) {
            $request = CampaignGetRequest::fromArray($request);
        }

        $response = $this->client->request('campaigns', 'get', $request->toArray());
        
        return collect($response['result']['Campaigns'] ?? [])
            ->map(fn (array $campaign) => Campaign::fromArray($campaign));
    }

    /**
     * Создать кампании
     *
     * @param CampaignAddItem|array $campaigns Кампании для создания
     * @return array Результат создания кампаний
     * @throws ApiException
     */
    public function add(CampaignAddItem|array $campaigns): array
    {
        if ($campaigns instanceof CampaignAddItem) {
            $campaigns = [$campaigns];
        }

        $params = [
            'Campaigns' => array_map(
                fn ($campaign) => $campaign instanceof CampaignAddItem ? $campaign->toArray() : $campaign,
                $campaigns
            )
        ];

        $response = $this->client->request('campaigns', 'add', $params);
        
        return $response['result'] ?? [];
    }

    /**
     * Обновить кампании
     *
     * @param CampaignUpdateItem|array $campaigns Массив кампаний для обновления
     * @return array Результат обновления кампаний
     * @throws ApiException
     */
    public function update(CampaignUpdateItem|array $campaigns): array
    {
        if ($campaigns instanceof CampaignUpdateItem) {
            $campaigns = [$campaigns];
        }

        $params = [
            'Campaigns' => array_map(
                fn ($campaign) => $campaign instanceof CampaignUpdateItem ? $campaign->toArray() : $campaign,
                $campaigns
            )
        ];

        $response = $this->client->request('campaigns', 'update', $params);
        
        return $response['result'] ?? [];
    }

    /**
     * Удалить кампании
     *
     * @param IdsCriteria|array $selectionCriteria Критерии отбора кампаний для удаления
     * @return array Результат удаления кампаний
     * @throws ApiException
     */
    public function delete(IdsCriteria|array $selectionCriteria): array
    {
        if (!$selectionCriteria instanceof IdsCriteria) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('campaigns', 'delete', $params);
        
        return $response['result'] ?? [];
    }

    /**
     * Приостановить кампании
     *
     * @param IdsCriteria|array $selectionCriteria Критерии отбора кампаний для приостановки
     * @return array Результат приостановки кампаний
     * @throws ApiException
     */
    public function suspend(IdsCriteria|array $selectionCriteria): array
    {
        if (!$selectionCriteria instanceof IdsCriteria) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('campaigns', 'suspend', $params);
        
        return $response['result'] ?? [];
    }

    /**
     * Возобновить кампании
     *
     * @param IdsCriteria|array $selectionCriteria Критерии отбора кампаний для возобновления
     * @return array Результат возобновления кампаний
     * @throws ApiException
     */
    public function resume(IdsCriteria|array $selectionCriteria): array
    {
        if (!$selectionCriteria instanceof IdsCriteria) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('campaigns', 'resume', $params);
        
        return $response['result'] ?? [];
    }

    /**
     * Архивировать кампании
     *
     * @param IdsCriteria|array $selectionCriteria Критерии отбора кампаний для архивации
     * @return array Результат архивации кампаний
     * @throws ApiException
     */
    public function archive(IdsCriteria|array $selectionCriteria): array
    {
        if (!$selectionCriteria instanceof IdsCriteria) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('campaigns', 'archive', $params);
        
        return $response['result'] ?? [];
    }

    /**
     * Разархивировать кампании
     *
     * @param IdsCriteria|array $selectionCriteria Критерии отбора кампаний для разархивации
     * @return array Результат разархивации кампаний
     * @throws ApiException
     */
    public function unarchive(IdsCriteria|array $selectionCriteria): array
    {
        if (!$selectionCriteria instanceof IdsCriteria) {
            $selectionCriteria = IdsCriteria::fromArray($selectionCriteria);
        }

        $params = [
            'SelectionCriteria' => $selectionCriteria->toArray()
        ];

        $response = $this->client->request('campaigns', 'unarchive', $params);
        
        return $response['result'] ?? [];
    }

    /**
     * Получить список доступных полей для кампаний
     *
     * @return array Список доступных полей
     * @throws ApiException
     */
    public function getAvailableFields(): array
    {
        $response = $this->client->request('campaigns', 'getAvailableFields');
        
        return $response['result'] ?? [];
    }

    /**
     * Получить список доступных типов кампаний
     *
     * @return array Список доступных типов кампаний
     * @throws ApiException
     */
    public function getAvailableTypes(): array
    {
        $response = $this->client->request('campaigns', 'getAvailableTypes');
        
        return $response['result'] ?? [];
    }

    /**
     * Получить список доступных статусов кампаний
     *
     * @return array Список доступных статусов кампаний
     * @throws ApiException
     */
    public function getAvailableStatuses(): array
    {
        $response = $this->client->request('campaigns', 'getAvailableStatuses');
        
        return $response['result'] ?? [];
    }
} 