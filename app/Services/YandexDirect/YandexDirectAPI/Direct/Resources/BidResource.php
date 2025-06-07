<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\BidGetRequest;
use App\Services\Yandex\Direct\DTO\BidSetItem;
use Illuminate\Support\Collection;

class BidResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить информацию о ставках
     *
     * @param BidGetRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(BidGetRequest|array $request = []): Collection
    {
        if (!($request instanceof BidGetRequest)) {
            $request = BidGetRequest::fromArray($request);
        }

        $response = $this->client->request('bids', 'get', $request->toArray());
        return collect($response['result']['Bids'] ?? []);
    }

    /**
     * Установить ставки
     *
     * @param BidSetItem|array $bids Ставки для установки
     * @return array
     */
    public function set(BidSetItem|array $bids): array
    {
        if (!($bids instanceof BidSetItem)) {
            $bids = BidSetItem::fromArray($bids);
        }

        $params = [
            'Bids' => [$bids->toArray()]
        ];

        $response = $this->client->request('bids', 'set', $params);
        return $response['result']['SetResults'] ?? [];
    }

    /**
     * Установить автоматические ставки
     *
     * @param BidSetItem|array $bids Ставки для установки
     * @return array
     */
    public function setAuto(BidSetItem|array $bids): array
    {
        if (!($bids instanceof BidSetItem)) {
            $bids = BidSetItem::fromArray($bids);
        }

        $params = [
            'Bids' => [$bids->toArray()]
        ];

        $response = $this->client->request('bids', 'setAuto', $params);
        return $response['result']['SetAutoResults'] ?? [];
    }
} 