<?php

namespace App\Services\Yandex\Direct\Api;

use App\Models\ApiSetting;
use App\Services\Yandex\Direct\Exceptions\ApiException;
use App\Services\Yandex\Direct\Resources\CampaignResource;
use App\Services\Yandex\Direct\Resources\AdGroupResource;
use App\Services\Yandex\Direct\Resources\AdResource;
use App\Services\Yandex\Direct\Resources\KeywordResource;
use App\Services\Yandex\Direct\Resources\BidResource;
use App\Services\Yandex\Direct\Resources\BidModifierResource;
use App\Services\Yandex\Direct\Resources\NegativeKeywordSharedSetResource;
use App\Services\Yandex\Direct\Resources\KeywordsResearchResource;
use App\Services\Yandex\Direct\Resources\BusinessResource;
use App\Services\Yandex\Direct\Resources\VCardResource;
use App\Services\Yandex\Direct\Resources\AdImageResource;
use App\Services\Yandex\Direct\Resources\CreativeResource;
use App\Services\Yandex\Direct\Resources\AdVideoResource;
use App\Services\Yandex\Direct\Resources\SitelinksResource;
use App\Services\Yandex\Direct\Resources\AdExtensionResource;
use App\Services\Yandex\Direct\Resources\DynamicFeedAdTargetResource;
use App\Services\Yandex\Direct\Resources\AudienceTargetResource;
use App\Services\Yandex\Direct\Resources\RetargetingListResource;
use App\Services\Yandex\Direct\Resources\SmartAdTargetResource;
use App\Services\Yandex\Direct\Resources\DynamicTextAdTargetResource;
use App\Services\Yandex\Direct\Resources\ClientResource;
use App\Services\Yandex\Direct\Resources\AgencyClientResource;
use App\Services\Yandex\Direct\Resources\FeedResource;
use App\Services\Yandex\Direct\Resources\DictionaryResource;
use Illuminate\Support\Facades\Http;

class Client
{
    private const BASE_URL = 'https://api.direct.yandex.com/json/v501/';

    private ApiSetting $settings;
    private array $headers;

    public function __construct()
    {
        $this->settings = ApiSetting::getServiceSettings(ApiSetting::SERVICE_YANDEX_DIRECT);
        
        if (!$this->settings->isTokenValid()) {
            throw new ApiException('Access token is invalid or expired');
        }

        $this->headers = [
            'Authorization' => 'Bearer ' . $this->settings->access_token,
            'Accept-Language' => 'ru',
            'Content-Type' => 'application/json; charset=utf-8',
        ];
    }

    /**
     * Получить ресурс для работы с кампаниями
     */
    public function campaigns(): CampaignResource
    {
        return new CampaignResource($this);
    }

    /**
     * Получить ресурс для работы с группами объявлений
     *
     * @return AdGroupResource
     */
    public function adGroups(): AdGroupResource
    {
        return new AdGroupResource($this);
    }

    /**
     * Получить ресурс для работы с объявлениями
     */
    public function ads(): AdResource
    {
        return new AdResource($this);
    }

    /**
     * Получить ресурс для работы с ключевыми фразами
     */
    public function keywords(): KeywordResource
    {
        return new KeywordResource($this);
    }

    /**
     * Получить ресурс для работы со ставками
     */
    public function bids(): BidResource
    {
        return new BidResource($this);
    }

    /**
     * Получить ресурс для работы с корректировками ставок
     */
    public function bidModifiers(): BidModifierResource
    {
        return new BidModifierResource($this);
    }

    /**
     * Получить ресурс для работы с наборами минус-фраз
     */
    public function negativeKeywordSharedSets(): NegativeKeywordSharedSetResource
    {
        return new NegativeKeywordSharedSetResource($this);
    }

    /**
     * Получить ресурс для работы с исследованием ключевых фраз
     */
    public function keywordsResearch(): KeywordsResearchResource
    {
        return new KeywordsResearchResource($this);
    }

    /**
     * Получить ресурс для работы с профилями организаций
     */
    public function businesses(): BusinessResource
    {
        return new BusinessResource($this);
    }

    /**
     * Получить ресурс для работы с виртуальными визитками
     */
    public function vCards(): VCardResource
    {
        return new VCardResource($this);
    }

    /**
     * Получить ресурс для работы с изображениями
     */
    public function adImages(): AdImageResource
    {
        return new AdImageResource($this);
    }

    /**
     * Получить ресурс для работы с креативами
     */
    public function creatives(): CreativeResource
    {
        return new CreativeResource($this);
    }

    /**
     * Получить ресурс для работы с видео
     */
    public function adVideos(): AdVideoResource
    {
        return new AdVideoResource($this);
    }

    /**
     * Получить ресурс для работы с наборами быстрых ссылок
     */
    public function sitelinks(): SitelinksResource
    {
        return new SitelinksResource($this);
    }

    /**
     * Получить ресурс для работы с расширениями к объявлениям
     */
    public function adExtensions(): AdExtensionResource
    {
        return new AdExtensionResource($this);
    }

    /**
     * Получить ресурс для работы с условиями нацеливания для динамических объявлений
     */
    public function dynamicFeedAdTargets(): DynamicFeedAdTargetResource
    {
        return new DynamicFeedAdTargetResource($this);
    }

    /**
     * Получить ресурс для работы с условиями нацеливания на аудиторию
     */
    public function audienceTargets(): AudienceTargetResource
    {
        return new AudienceTargetResource($this);
    }

    /**
     * Получить ресурс для работы с условиями ретаргетинга
     */
    public function retargetingLists(): RetargetingListResource
    {
        return new RetargetingListResource($this);
    }

    /**
     * Получить ресурс для работы с фильтрами смарт-баннеров
     */
    public function smartAdTargets(): SmartAdTargetResource
    {
        return new SmartAdTargetResource($this);
    }

    /**
     * Получить ресурс для работы с параметрами рекламодателя
     */
    public function clients(): ClientResource
    {
        return new ClientResource($this);
    }

    /**
     * Получить ресурс для работы с клиентами агентства
     */
    public function agencyClients(): AgencyClientResource
    {
        return new AgencyClientResource($this);
    }

    /**
     * Получить ресурс для работы с лентами
     */
    public function feeds(): FeedResource
    {
        return new FeedResource($this);
    }

    /**
     * Получить ресурс для работы со словарями
     */
    public function dictionaries(): DictionaryResource
    {
        return new DictionaryResource($this);
    }

    /**
     * Выполнить запрос к API
     *
     * @param string $resource Название ресурса
     * @param string $method Название метода
     * @param array $params Параметры запроса
     * @return array Ответ API
     * @throws ApiException
     */
    public function request(string $resource, string $method, array $params = []): array
    {
        $url = self::BASE_URL . $resource;

        $response = Http::withHeaders($this->headers)
            ->post($url, [
                'method' => $method,
                'params' => $params,
            ]);

        if (!$response->successful()) {
            throw new ApiException(
                'API request failed: ' . $response->body(),
                $response->status(),
                ['response' => $response->json()]
            );
        }

        $data = $response->json();

        if (isset($data['error'])) {
            throw new ApiException(
                'API error: ' . ($data['error']['error_string'] ?? 'Unknown error'),
                $data['error']['error_code'] ?? 0,
                ['error' => $data['error']]
            );
        }

        return $data;
    }

    /**
     * Получить список кампаний
     *
     * @param array $params Параметры запроса
     * @return array
     */
    public function getCampaigns(array $params = []): array
    {
        return $this->request('campaigns', 'get', $params);
    }

    /**
     * Получить список групп объявлений
     *
     * @param array $params Параметры запроса
     * @return array
     */
    public function getAdGroups(array $params = []): array
    {
        return $this->request('adgroups', 'get', $params);
    }

    /**
     * Получить список объявлений
     *
     * @param array $params Параметры запроса
     * @return array
     */
    public function getAds(array $params = []): array
    {
        return $this->request('ads', 'get', $params);
    }

    /**
     * Получить список ключевых слов
     *
     * @param array $params Параметры запроса
     * @return array
     */
    public function getKeywords(array $params = []): array
    {
        return $this->request('keywords', 'get', $params);
    }

    /**
     * Получить статистику
     *
     * @param array $params Параметры запроса
     * @return array
     */
    public function getReport(array $params = []): array
    {
        return $this->request('reports', 'get', $params);
    }
} 