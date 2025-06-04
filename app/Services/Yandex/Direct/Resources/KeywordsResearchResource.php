<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\KeywordsResearchRequest;
use Illuminate\Support\Collection;

class KeywordsResearchResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить результаты исследования ключевых фраз
     *
     * @param KeywordsResearchRequest|array $request Параметры запроса
     * @return Collection
     */
    public function get(KeywordsResearchRequest|array $request): Collection
    {
        if (!($request instanceof KeywordsResearchRequest)) {
            $request = KeywordsResearchRequest::fromArray($request);
        }

        $response = $this->client->request('keywordsresearch', 'get', $request->toArray());
        return collect($response['result']['Keywords'] ?? []);
    }
} 