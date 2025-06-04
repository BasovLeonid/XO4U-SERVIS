<?php

namespace App\Services\Yandex\Direct\Resources;

use App\Services\Yandex\Direct\Api\Client;
use App\Services\Yandex\Direct\DTO\Dictionary\DictionaryGetRequest;
use Illuminate\Support\Collection;

class DictionaryResource
{
    public function __construct(
        private readonly Client $client
    ) {}

    /**
     * Получить справочные данные
     *
     * @param DictionaryGetRequest|array $request
     * @return Collection
     */
    public function get(DictionaryGetRequest|array $request): Collection
    {
        if (is_array($request)) {
            $request = DictionaryGetRequest::fromArray($request);
        }

        $response = $this->client->request('dictionaries', 'get', [
            'params' => $request->toArray()
        ]);

        return collect($response['result'] ?? []);
    }
} 