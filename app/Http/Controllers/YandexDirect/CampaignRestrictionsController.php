<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use App\Services\DataStorage\DataStorageService;
use Illuminate\Http\Request;

class CampaignRestrictionsController extends Controller
{
    protected $dataStorage;

    public function __construct(DataStorageService $dataStorage)
    {
        $this->dataStorage = $dataStorage;
    }

    /**
     * Обработка данных ограничений
     *
     * @param array $data
     * @return array
     */
    public function process(array $data): array
    {
        // Валидация данных
        $validated = $this->validateData($data);

        // Подготовка данных для сохранения
        $preparedData = $this->prepareData($validated);

        // Сохранение данных
        return $this->dataStorage->save('campaign_restrictions', $preparedData);
    }

    /**
     * Валидация данных
     *
     * @param array $data
     * @return array
     */
    protected function validateData(array $data): array
    {
        return validator($data, [
            'negative_keywords' => 'nullable|array',
            'negative_keywords.*' => 'string|max:255',
            'excluded_sites' => 'nullable|array',
            'excluded_sites.*' => 'url',
            'blocked_ips' => 'nullable|array',
            'blocked_ips.*' => 'ip'
        ])->validate();
    }

    /**
     * Подготовка данных для сохранения
     *
     * @param array $data
     * @return array
     */
    protected function prepareData(array $data): array
    {
        return [
            'negative_keywords' => json_encode($data['negative_keywords'] ?? []),
            'excluded_sites' => json_encode($data['excluded_sites'] ?? []),
            'blocked_ips' => json_encode($data['blocked_ips'] ?? []),
            'updated_at' => now()
        ];
    }
} 