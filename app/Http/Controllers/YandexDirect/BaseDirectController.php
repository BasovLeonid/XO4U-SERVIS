<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

abstract class BaseDirectController extends Controller
{
    /**
     * Обработка входящих данных
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function handleUpdate(Request $request): JsonResponse
    {
        try {
            // Получаем только измененные поля
            $changedData = $this->getChangedData($request);
            
            if (empty($changedData)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Нет изменений для сохранения'
                ]);
            }

            // Группируем данные по таблицам
            $groupedData = $this->groupDataByTables($changedData);
            
            // Обрабатываем каждую группу данных
            foreach ($groupedData as $table => $data) {
                $model = $this->getModelForTable($table);
                $model->updateOrCreate(
                    ['campaign_id' => $data['campaign_id']],
                    $data
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Данные успешно обновлены'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении данных: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Получение только измененных данных из запроса
     *
     * @param Request $request
     * @return array
     */
    protected function getChangedData(Request $request): array
    {
        $currentData = $this->getCurrentData();
        $newData = $request->all();
        
        return array_filter($newData, function($value, $key) use ($currentData) {
            return !isset($currentData[$key]) || $currentData[$key] !== $value;
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Группировка данных по таблицам
     *
     * @param array $data
     * @return array
     */
    protected function groupDataByTables(array $data): array
    {
        $mapping = [
            'campaigns' => [
                'name', 'status', 'url', 'daily_budget_amount', 'daily_budget_mode'
            ],
            'campaign_settings' => [
                'search_bidding_strategy_type', 'search_bidding_strategy',
                'network_bidding_strategy_type', 'network_bidding_strategy'
            ],
            'campaign_placements' => [
                'search_placement_types', 'network_placement_types'
            ],
            'campaign_schedule' => [
                'time_targeting_schedule', 'consider_working_weekends'
            ],
            'campaign_corrections' => [
                'bid_adjustments'
            ],
            'campaign_restrictions' => [
                'negative_keywords', 'excluded_sites', 'blocked_ips'
            ],
            'campaign_additional' => [
                'tracking_params', 'counter_ids', 'goals'
            ]
        ];

        $grouped = [];
        foreach ($mapping as $table => $fields) {
            $tableData = Arr::only($data, $fields);
            if (!empty($tableData)) {
                $grouped[$table] = $tableData;
            }
        }

        return $grouped;
    }

    /**
     * Получение модели для конкретной таблицы
     *
     * @param string $table
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function getModelForTable(string $table): \Illuminate\Database\Eloquent\Model
    {
        $models = [
            'campaigns' => \App\Models\YandexDirect\Campaign::class,
            'campaign_settings' => \App\Models\YandexDirect\CampaignSetting::class,
            'campaign_placements' => \App\Models\YandexDirect\CampaignPlacement::class,
            'campaign_schedule' => \App\Models\YandexDirect\CampaignSchedule::class,
            'campaign_corrections' => \App\Models\YandexDirect\CampaignCorrection::class,
            'campaign_restrictions' => \App\Models\YandexDirect\CampaignRestriction::class,
            'campaign_additional' => \App\Models\YandexDirect\CampaignAdditional::class
        ];

        return app($models[$table]);
    }

    /**
     * Получение текущих данных
     *
     * @return array
     */
    abstract protected function getCurrentData(): array;
} 