<?php

namespace App\Http\Controllers\YandexDirect;

use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CampaignController extends BaseDirectController
{
    /**
     * Отображение списка кампаний
     *
     * @return \Illuminate\View\View
     */
    /*
    public function index()
    {
        $campaigns = Campaign::with(['settings', 'placements', 'schedule', 'corrections', 'restrictions', 'additional'])
            ->paginate(10);
        return view('yandex-direct.campaigns.index', compact('campaigns'));
    }
    */

    /**
     * Отображение формы создания кампании
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        // Получаем параметры из GET-запроса
        $type = $request->get('type', 'users');
        $templateId = $request->get('id_template');
        $back = $request->get('back');
        
        \Log::info('Template data:', [
            'type' => $type,
            'template_id' => $templateId,
            'back' => $back,
            'all_parameters' => $request->all()
        ]);
        
        $campaign = Campaign::create([
            'name' => 'Новая кампания',
            'status' => 'draft',
            'type' => $type,
            'template_id' => $templateId
        ]);

        // Формируем URL для редиректа
        $redirectUrl = route('interface.yandex-direct.settings', ['campaign' => $campaign->id]);
        $redirectUrl .= '?type=' . $type;
        if ($templateId) {
            $redirectUrl .= '&id_template=' . $templateId;
        }
        if ($back) {
            $redirectUrl .= '&back=' . urlencode($back);
        }

        return redirect($redirectUrl)
            ->with('success', 'Кампания успешно создана');
    }

    /**
     * Сохранение новой кампании
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /*
    public function store(Request $request)
    {
        $validated = Campaign::validate($request->all());
        $campaign = Campaign::create($validated);

        return redirect()
            ->route('boss.direct-templates.campaigns.edit', $campaign)
            ->with('success', 'Кампания успешно создана');
    }
    */

    /**
     * Отображение кампании
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function show(Campaign $campaign)
    {
        $campaign->load(['settings', 'placements', 'schedule', 'corrections', 'restrictions', 'additional']);
        return view('yandex-direct.campaigns.show', compact('campaign'));
    }
    */

    /**
     * Отображение страницы настроек кампании
     *
     * @param Request $request
     * @param int $campaign
     * @return \Illuminate\View\View
     */
    public function settings(Request $request, $campaign)
    {
        $campaign = Campaign::where('id', $campaign)
            ->firstOrFail();
            
        // Получаем параметры из сессии или из GET-запроса
        $type = session('type', $request->get('type'));
        $templateId = session('id_template', $request->get('id_template'));
        $back = session('back', $request->get('back'));
            
        return view('yandex-direct.interface_setting', [
            'campaign' => $campaign,
            'type' => $type,
            'template_id' => $templateId,
            'back' => $back
        ]);
    }

    /**
     * Отображение страницы расписания
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function schedule(Campaign $campaign)
    {
        $campaign->load('schedule');
        return view('yandex-direct.campaigns.schedule', compact('campaign'));
    }
    */

    /**
     * Отображение страницы ограничений
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function restrictions(Campaign $campaign)
    {
        $campaign->load('restrictions');
        return view('yandex-direct.campaigns.restrictions', compact('campaign'));
    }
    */

    /**
     * Отображение страницы корректировок
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function corrections(Campaign $campaign)
    {
        $campaign->load('corrections');
        return view('yandex-direct.campaigns.corrections', compact('campaign'));
    }
    */

    /**
     * Отображение страницы дополнительных настроек
     *
     * @param Campaign $campaign
     * @return \Illuminate\View\View
     */
    /*
    public function additionalSettings(Campaign $campaign)
    {
        $campaign->load('additional');
        return view('yandex-direct.campaigns.additional-settings', compact('campaign'));
    }
    */

    /**
     * Обновление настроек кампании
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function updateSettings(Request $request, Campaign $campaign): JsonResponse
    {
        try {
            // Получаем все данные из запроса
            $data = $request->all();
            
            // Обновляем основные данные кампании
            $campaign->update([
                'name' => $data['name'] ?? $campaign->name,
                'status' => $data['status'] ?? $campaign->status,
                'url' => $data['url'] ?? $campaign->url,
                'daily_budget_amount' => $data['daily_budget_amount'] ?? $campaign->daily_budget_amount,
                'daily_budget_mode' => $data['daily_budget_mode'] ?? $campaign->daily_budget_mode,
            ]);

            // Обновляем настройки кампании
            if ($campaign->settings) {
                $campaign->settings->update([
                    'search_bidding_strategy_type' => $data['search_bidding_strategy_type'] ?? $campaign->settings->search_bidding_strategy_type,
                    'search_bidding_strategy' => $data['search_bidding_strategy'] ?? $campaign->settings->search_bidding_strategy,
                    'network_bidding_strategy_type' => $data['network_bidding_strategy_type'] ?? $campaign->settings->network_bidding_strategy_type,
                    'network_bidding_strategy' => $data['network_bidding_strategy'] ?? $campaign->settings->network_bidding_strategy,
                ]);
            }

            // Обновляем размещения
            if ($campaign->placements) {
                $campaign->placements->update([
                    'search_placement_types' => $data['search_placement_types'] ?? $campaign->placements->search_placement_types,
                    'network_placement_types' => $data['network_placement_types'] ?? $campaign->placements->network_placement_types,
                ]);
            }

            // Обновляем расписание
            if ($campaign->schedule) {
                $campaign->schedule->update([
                    'time_targeting_schedule' => $data['time_targeting_schedule'] ?? $campaign->schedule->time_targeting_schedule,
                    'consider_working_weekends' => $data['consider_working_weekends'] ?? $campaign->schedule->consider_working_weekends,
                ]);
            }

            // Обновляем корректировки
            if ($campaign->corrections) {
                $campaign->corrections->update([
                    'bid_adjustments' => $data['bid_adjustments'] ?? $campaign->corrections->bid_adjustments,
                ]);
            }

            // Обновляем ограничения
            if ($campaign->restrictions) {
                $campaign->restrictions->update([
                    'negative_keywords' => $data['negative_keywords'] ?? $campaign->restrictions->negative_keywords,
                    'excluded_sites' => $data['excluded_sites'] ?? $campaign->restrictions->excluded_sites,
                    'blocked_ips' => $data['blocked_ips'] ?? $campaign->restrictions->blocked_ips,
                ]);
            }

            // Обновляем дополнительные настройки
            if ($campaign->additional) {
                $campaign->additional->update([
                    'tracking_params' => $data['tracking_params'] ?? $campaign->additional->tracking_params,
                    'counter_ids' => $data['counter_ids'] ?? $campaign->additional->counter_ids,
                    'goals' => $data['goals'] ?? $campaign->additional->goals,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Настройки кампании успешно обновлены',
                'data' => [
                    'campaign' => $campaign->fresh([
                        'settings',
                        'placements',
                        'schedule',
                        'corrections',
                        'restrictions',
                        'additional'
                    ])
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Ошибка при обновлении настроек кампании: ' . $e->getMessage(), [
                'campaign_id' => $campaign->id,
                'data' => $request->all(),
                'exception' => $e
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении настроек: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Обновление отдельного раздела настроек
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function updateSettingsSection(Request $request, Campaign $campaign): JsonResponse
    {
        return $this->handleUpdate($request);
    }

    /**
     * Удаление кампании
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Campaign $campaign)
    {
        try {
            $campaign->delete();

            // Получаем URL для возврата из GET-параметра
            $backUrl = $request->get('back');

            return redirect($backUrl)
                ->with('success', 'Кампания успешно удалена');
        } catch (\Exception $e) {
            \Log::error('Ошибка при удалении кампании: ' . $e->getMessage(), [
                'campaign_id' => $campaign->id,
                'exception' => $e
            ]);

            return redirect()->back()
                ->with('error', 'Ошибка при удалении кампании: ' . $e->getMessage());
        }
    }

    /**
     * Получение текущих данных кампании
     *
     * @return array
     */
    protected function getCurrentData(): array
    {
        $campaign = Campaign::with([
            'settings',
            'placements',
            'schedule',
            'corrections',
            'restrictions',
            'additional'
        ])->find(request()->route('campaign'));

        return array_merge(
            $campaign->toArray(),
            $campaign->settings->toArray(),
            $campaign->placements->toArray(),
            $campaign->schedule->toArray(),
            $campaign->corrections->toArray(),
            $campaign->restrictions->toArray(),
            $campaign->additional->toArray()
        );
    }

    /**
     * Получение счетчиков Яндекс.Метрики
     *
     * @return array
     */
    protected function getCounters(): array
    {
        // TODO: Реализовать получение счетчиков
        return [];
    }

    /**
     * Получение целей Яндекс.Метрики
     *
     * @return array
     */
    protected function getGoals(): array
    {
        // TODO: Реализовать получение целей
        return [];
    }
} 