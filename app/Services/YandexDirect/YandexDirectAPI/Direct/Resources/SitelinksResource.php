<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\SitelinksGetRequest;
use App\Services\Yandex\Direct\DTO\SitelinksSetAddItem;
use App\Services\Yandex\Direct\DTO\IdsCriteria;
use Illuminate\Support\Collection;

class SitelinksResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить наборы быстрых ссылок
     *
     * @param SitelinksGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(SitelinksGetRequest|array $request = []): Collection
    {
        if (!($request instanceof SitelinksGetRequest)) {
            $request = SitelinksGetRequest::fromArray($request);
        }

        $response = $this->client->request('sitelinks', 'get', $request->toArray());
        return collect($response['result']['SitelinksSets'] ?? []);
    }

    /**
     * Добавить наборы быстрых ссылок
     *
     * @param SitelinksSetAddItem|array $sitelinksSets Наборы быстрых ссылок для добавления
     * @return array
     */
    public function add(SitelinksSetAddItem|array $sitelinksSets): array
    {
        if (!($sitelinksSets instanceof SitelinksSetAddItem)) {
            $sitelinksSets = SitelinksSetAddItem::fromArray($sitelinksSets);
        }

        $params = [
            'SitelinksSets' => [$sitelinksSets->toArray()]
        ];

        $response = $this->client->request('sitelinks', 'add', $params);
        return $response['result']['AddResults'] ?? [];
    }

    /**
     * Удалить наборы быстрых ссылок
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

        $response = $this->client->request('sitelinks', 'delete', $params);
        return $response['result']['DeleteResults'] ?? [];
    }
} 