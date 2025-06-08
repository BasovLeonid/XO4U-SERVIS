<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::paginate(10);
        return view('yandex-direct.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('yandex-direct.campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'type' => 'required|string',
            'settings' => 'required|array',
            'content' => 'required|array'
        ]);

        $campaign = Campaign::create($validated);

        return redirect()
            ->route('yandex-direct.campaigns.edit', $campaign)
            ->with('success', 'Кампания успешно создана');
    }

    public function edit(Campaign $campaign)
    {
        return view('yandex-direct.campaigns.edit', [
            'campaign' => $campaign,
            'counters' => $this->getCounters(),
            'goals' => $this->getGoals()
        ]);
    }

    /**
     * Обновление настроек кампании
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function update(Request $request, Campaign $campaign): JsonResponse
    {
        try {
            // Валидация входящих данных
            $validated = $request->validate([
                // Основные настройки
                'name' => 'required|string|max:255',
                'status' => 'required|in:active,paused,stopped',
                'url' => 'required|url',
                
                // Бюджет
                'daily_budget_amount' => 'required|numeric|min:0',
                'daily_budget_mode' => 'required|in:STANDARD,DISTRIBUTED',
                
                // Стратегии
                'search_bidding_strategy_type' => 'nullable|string',
                'search_bidding_strategy' => 'nullable|array',
                'network_bidding_strategy_type' => 'nullable|string',
                'network_bidding_strategy' => 'nullable|array',
                
                // Места показа
                'search_placement_types' => 'nullable|array',
                'network_placement_types' => 'nullable|array',
                
                // Расписание
                'time_targeting_schedule' => 'nullable|array',
                'consider_working_weekends' => 'nullable|in:YES,NO',
                
                // Корректировки
                'bid_adjustments' => 'nullable|array',
                
                // Ограничения
                'negative_keywords' => 'nullable|array',
                'excluded_sites' => 'nullable|array',
                'blocked_ips' => 'nullable|array',
                
                // Дополнительные настройки
                'tracking_params' => 'nullable|string',
                'counter_ids' => 'nullable|array',
                'goals' => 'nullable|array',
            ]);

            // Обновление данных кампании
            $campaign->update($validated);

            // Подготовка ответа
            return response()->json([
                'success' => true,
                'message' => 'Настройки кампании успешно обновлены',
                'redirect' => route('yandex-direct.campaigns.show', $campaign)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении настроек: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()
            ->route('yandex-direct.campaigns.index')
            ->with('success', 'Кампания успешно удалена');
    }

    protected function getCounters()
    {
        // TODO: Реализовать получение счетчиков из Яндекс.Метрики
        return [];
    }

    protected function getGoals()
    {
        // TODO: Реализовать получение целей из Яндекс.Метрики
        return [];
    }
} 