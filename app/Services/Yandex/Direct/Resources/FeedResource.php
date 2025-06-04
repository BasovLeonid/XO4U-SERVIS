<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\Feed\FeedAddItem;
use App\Services\Yandex\Direct\DTO\Feed\FeedGetRequest;
use App\Services\Yandex\Direct\DTO\Feed\FeedUpdateItem;
use Illuminate\Support\Collection;

class FeedResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить фиды
     *
     * @param FeedGetRequest|array $request
     * @return Collection
     */
    public function get(FeedGetRequest|array $request = []): Collection
    {
        if (is_array($request)) {
            $request = FeedGetRequest::fromArray($request);
        }

        $response = $this->client->request('feeds', 'get', [
            'params' => $request->toArray()
        ]);

        return collect($response['result']['Feeds'] ?? []);
    }

    /**
     * Добавить фиды
     *
     * @param FeedAddItem|array $feeds
     * @return Collection
     */
    public function add(FeedAddItem|array $feeds): Collection
    {
        if (is_array($feeds)) {
            $feeds = FeedAddItem::fromArray($feeds);
        }

        $response = $this->client->request('feeds', 'add', [
            'params' => [
                'Feeds' => [$feeds->toArray()]
            ]
        ]);

        return collect($response['result']['AddResults'] ?? []);
    }

    /**
     * Обновить фиды
     *
     * @param FeedUpdateItem|array $feeds
     * @return Collection
     */
    public function update(FeedUpdateItem|array $feeds): Collection
    {
        if (is_array($feeds)) {
            $feeds = FeedUpdateItem::fromArray($feeds);
        }

        $response = $this->client->request('feeds', 'update', [
            'params' => [
                'Feeds' => [$feeds->toArray()]
            ]
        ]);

        return collect($response['result']['UpdateResults'] ?? []);
    }

    /**
     * Удалить фиды
     *
     * @param array $selectionCriteria
     * @return Collection
     */
    public function delete(array $selectionCriteria): Collection
    {
        $response = $this->client->request('feeds', 'delete', [
            'params' => [
                'SelectionCriteria' => $selectionCriteria
            ]
        ]);

        return collect($response['result']['DeleteResults'] ?? []);
    }
} 