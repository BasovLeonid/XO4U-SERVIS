<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\AudienceTargetGetRequest;
use App\Services\Yandex\Direct\DTO\AudienceTargetAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class AudienceTargetResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить условия нацеливания на аудиторию
     *
     * @param AudienceTargetGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(AudienceTargetGetRequest|array $request = []): Collection
    {
        if (!($request instanceof AudienceTargetGetRequest)) {
            $request = AudienceTargetGetRequest::fromArray($request);
        }

        $response = $this->client->request('audiencetargets', 'get', $request->toArray());
        return collect($response['result']['AudienceTargets'] ?? []);
    }

    /**
     * Добавить условия нацеливания на аудиторию
     *
     * @param AudienceTargetAddItem|array $targets Условия нацеливания для добавления
     * @return array
     */
    public function add(AudienceTargetAddItem|array $targets): array
    {
        if (!($targets instanceof AudienceTargetAddItem)) {
            $targets = AudienceTargetAddItem::fromArray($targets);
        }

        $params = [
            'AudienceTargets' => [$targets->toArray()]
        ];

        $response = $this->client->request('audiencetargets', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Удалить условия нацеливания на аудиторию
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

        $response = $this->client->request('audiencetargets', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }

    /**
     * Приостановить показ условий нацеливания на аудиторию
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

        $response = $this->client->request('audiencetargets', 'suspend', $params);
        return $response['result']['SuspendResults'] ?? [];
    }

    /**
     * Возобновить показ условий нацеливания на аудиторию
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

        $response = $this->client->request('audiencetargets', 'resume', $params);
        return $response['result']['ResumeResults'] ?? [];
    }

    /**
     * Установить ставки для условий нацеливания на аудиторию
     *
     * @param array $bids Массив ставок
     * @return array
     */
    public function setBids(array $bids): array
    {
        $params = [
            'Bids' => $bids
        ];

        $response = $this->client->request('audiencetargets', 'setBids', $params);
        return $response['result']['SetBidsResults'] ?? [];
    }
} 