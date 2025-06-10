<?php

namespace App\Http\Controllers\YandexDirect;

use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
    public function updateSettings(Request $request, Campaign $campaign)
    {   
        //dd($request->all());
        try {
            DB::beginTransaction();

            // Получаем все данные из запроса
            $data = $request->all();
            
            // 1. Обновляем основные данные кампании (direct_campaigns)
            $campaign->update([
                'name' => $data['name'] ?? $campaign->name,
                'status' => $data['status'] ?? $campaign->status,
                'url' => $data['url'] ?? $campaign->url,
                'daily_budget_amount' => $data['daily_budget_amount'] ?? $campaign->daily_budget_amount,
                'daily_budget_mode' => $data['daily_budget_mode'] ?? $campaign->daily_budget_mode,
                'search_result' => $data['search_result'] ?? $campaign->search_result,
                'dynamic_places' => $data['dynamic_places'] ?? $campaign->dynamic_places,
                'product_gallery' => $data['product_gallery'] ?? $campaign->product_gallery,
                'search_organization_list' => $data['search_organization_list'] ?? $campaign->search_organization_list,
                'network' => $data['network'] ?? $campaign->network,
                'maps' => $data['maps'] ?? $campaign->maps,
            ]);

            // 2. Обновляем корректировки ставок (direct_campaign_bid_adjustments)
            if ($campaign->bidAdjustments) {
                $campaign->bidAdjustments->update([
                    'mobile_adjustment' => $data['mobile_adjustment'] ?? $campaign->bidAdjustments->mobile_adjustment,
                    'tablet_adjustment' => $data['tablet_adjustment'] ?? $campaign->bidAdjustments->tablet_adjustment,
                    'desktop_adjustment' => $data['desktop_adjustment'] ?? $campaign->bidAdjustments->desktop_adjustment,
                    'desktop_only_adjustment' => $data['desktop_only_adjustment'] ?? $campaign->bidAdjustments->desktop_only_adjustment,
                    'demographics_adjustments' => $data['demographics_adjustments'] ?? $campaign->bidAdjustments->demographics_adjustments,
                    'retargeting_adjustments' => $data['retargeting_adjustments'] ?? $campaign->bidAdjustments->retargeting_adjustments,
                    'regional_adjustments' => $data['regional_adjustments'] ?? $campaign->bidAdjustments->regional_adjustments,
                    'video_adjustment' => $data['video_adjustment'] ?? $campaign->bidAdjustments->video_adjustment,
                    'smart_ad_adjustment' => $data['smart_ad_adjustment'] ?? $campaign->bidAdjustments->smart_ad_adjustment,
                    'serp_layout_adjustments' => $data['serp_layout_adjustments'] ?? $campaign->bidAdjustments->serp_layout_adjustments,
                    'income_grade_adjustments' => $data['income_grade_adjustments'] ?? $campaign->bidAdjustments->income_grade_adjustments,
                    'ad_group_adjustment' => $data['ad_group_adjustment'] ?? $campaign->bidAdjustments->ad_group_adjustment,
                ]);
            }

            // 3. Обновляем исключения (direct_campaign_exclusions)
            if ($campaign->exclusions) {
                $campaign->exclusions->update([
                    'blocked_ips' => $data['blocked_ips'] ?? $campaign->exclusions->blocked_ips,
                    'excluded_sites' => $data['excluded_sites'] ?? $campaign->exclusions->excluded_sites,
                ]);
            }

            // 4. Обновляем метрики (direct_campaign_metrics)
            if ($campaign->metrics) {
                $campaign->metrics->update([
                    'counter_ids' => $data['counter_ids'] ?? $campaign->metrics->counter_ids,
                    'primary_counter_id' => $data['primary_counter_id'] ?? $campaign->metrics->primary_counter_id,
                    'priority_goals' => $data['priority_goals'] ?? $campaign->metrics->priority_goals,
                    'primary_goal_id' => $data['primary_goal_id'] ?? $campaign->metrics->primary_goal_id,
                    'primary_goal_value' => $data['primary_goal_value'] ?? $campaign->metrics->primary_goal_value,
                ]);
            }

            // 5. Обновляем минус-слова (direct_campaign_negative_keywords)
            if ($campaign->negativeKeywords) {
                $campaign->negativeKeywords->update([
                    'negative_keywords' => $data['negative_keywords'] ?? $campaign->negativeKeywords->negative_keywords,
                ]);
            }

            // 6. Обновляем стратегии в сетях (direct_campaign_network_strategies)
            if ($campaign->networkStrategies) {
                $campaign->networkStrategies->update([
                    'network_strategy_type' => $data['network_strategy_type'] ?? $campaign->networkStrategies->network_strategy_type,
                    'network_wb_maximum_clicks_weekly_spend_limit' => $data['network_wb_maximum_clicks_weekly_spend_limit'] ?? $campaign->networkStrategies->network_wb_maximum_clicks_weekly_spend_limit,
                    'network_wb_maximum_clicks_bid_ceiling' => $data['network_wb_maximum_clicks_bid_ceiling'] ?? $campaign->networkStrategies->network_wb_maximum_clicks_bid_ceiling,
                    'network_average_cpc_average_cpc' => $data['network_average_cpc_average_cpc'] ?? $campaign->networkStrategies->network_average_cpc_average_cpc,
                    'network_average_cpc_weekly_spend_limit' => $data['network_average_cpc_weekly_spend_limit'] ?? $campaign->networkStrategies->network_average_cpc_weekly_spend_limit,
                    'network_wb_maximum_conversion_rate_weekly_spend_limit' => $data['network_wb_maximum_conversion_rate_weekly_spend_limit'] ?? $campaign->networkStrategies->network_wb_maximum_conversion_rate_weekly_spend_limit,
                    'network_wb_maximum_conversion_rate_bid_ceiling' => $data['network_wb_maximum_conversion_rate_bid_ceiling'] ?? $campaign->networkStrategies->network_wb_maximum_conversion_rate_bid_ceiling,
                    'network_wb_maximum_conversion_rate_goal_id' => $data['network_wb_maximum_conversion_rate_goal_id'] ?? $campaign->networkStrategies->network_wb_maximum_conversion_rate_goal_id,
                    'network_average_cpa_weekly_spend_limit' => $data['network_average_cpa_weekly_spend_limit'] ?? $campaign->networkStrategies->network_average_cpa_weekly_spend_limit,
                    'network_average_cpa_bid_ceiling' => $data['network_average_cpa_bid_ceiling'] ?? $campaign->networkStrategies->network_average_cpa_bid_ceiling,
                    'network_average_cpa_exploration_budget' => $data['network_average_cpa_exploration_budget'] ?? $campaign->networkStrategies->network_average_cpa_exploration_budget,
                    'network_average_cpa_goal_id' => $data['network_average_cpa_goal_id'] ?? $campaign->networkStrategies->network_average_cpa_goal_id,
                    'network_average_cpa_average_cpa' => $data['network_average_cpa_average_cpa'] ?? $campaign->networkStrategies->network_average_cpa_average_cpa,
                    'network_average_cpa_multiple_goals_weekly_spend_limit' => $data['network_average_cpa_multiple_goals_weekly_spend_limit'] ?? $campaign->networkStrategies->network_average_cpa_multiple_goals_weekly_spend_limit,
                    'network_average_cpa_multiple_goals_bid_ceiling' => $data['network_average_cpa_multiple_goals_bid_ceiling'] ?? $campaign->networkStrategies->network_average_cpa_multiple_goals_bid_ceiling,
                    'network_average_cpa_multiple_goals_exploration_budget' => $data['network_average_cpa_multiple_goals_exploration_budget'] ?? $campaign->networkStrategies->network_average_cpa_multiple_goals_exploration_budget,
                    'network_average_cpa_multiple_goals_priority_goals' => $data['network_average_cpa_multiple_goals_priority_goals'] ?? $campaign->networkStrategies->network_average_cpa_multiple_goals_priority_goals,
                    'network_pay_for_conversion_weekly_spend_limit' => $data['network_pay_for_conversion_weekly_spend_limit'] ?? $campaign->networkStrategies->network_pay_for_conversion_weekly_spend_limit,
                    'network_pay_for_conversion_cpa' => $data['network_pay_for_conversion_cpa'] ?? $campaign->networkStrategies->network_pay_for_conversion_cpa,
                    'network_pay_for_conversion_goal_id' => $data['network_pay_for_conversion_goal_id'] ?? $campaign->networkStrategies->network_pay_for_conversion_goal_id,
                    'network_pay_for_conversion_multiple_goals_weekly_spend_limit' => $data['network_pay_for_conversion_multiple_goals_weekly_spend_limit'] ?? $campaign->networkStrategies->network_pay_for_conversion_multiple_goals_weekly_spend_limit,
                    'network_pay_for_conversion_multiple_goals_priority_goals' => $data['network_pay_for_conversion_multiple_goals_priority_goals'] ?? $campaign->networkStrategies->network_pay_for_conversion_multiple_goals_priority_goals,
                ]);
            }

            // 7. Обновляем расписание (direct_campaign_schedules)
            if ($campaign->schedule) {
                $campaign->schedule->update([
                    'start_date' => $data['start_date'] ?? $campaign->schedule->start_date,
                    'end_date' => $data['end_date'] ?? $campaign->schedule->end_date,
                    'time_zone' => $data['time_zone'] ?? $campaign->schedule->time_zone,
                    'time_targeting_type' => $data['time_targeting_type'] ?? $campaign->schedule->time_targeting_type,
                    'time_targeting_custom' => $data['time_targeting_custom'] ?? $campaign->schedule->time_targeting_custom,
                    'time_targeting_budni' => $data['time_targeting_budni'] ?? $campaign->schedule->time_targeting_budni,
                    'time_targeting_set1' => $data['time_targeting_set1'] ?? $campaign->schedule->time_targeting_set1,
                    'time_targeting_set2' => $data['time_targeting_set2'] ?? $campaign->schedule->time_targeting_set2,
                    'time_targeting_set3' => $data['time_targeting_set3'] ?? $campaign->schedule->time_targeting_set3,
                    'consider_working_weekends' => $data['consider_working_weekends'] ?? $campaign->schedule->consider_working_weekends,
                    'holidays_schedule' => $data['holidays_schedule'] ?? $campaign->schedule->holidays_schedule,
                ]);
            }

            // 8. Обновляем стратегии поиска (direct_campaign_search_strategies)
            if ($campaign->searchStrategies) {
                $campaign->searchStrategies->update([
                    'search_strategy_type' => $data['search_strategy_type'] ?? $campaign->searchStrategies->search_strategy_type,
                    'search_wb_maximum_clicks_weekly_spend_limit' => $data['search_wb_maximum_clicks_weekly_spend_limit'] ?? $campaign->searchStrategies->search_wb_maximum_clicks_weekly_spend_limit,
                    'search_wb_maximum_clicks_bid_ceiling' => $data['search_wb_maximum_clicks_bid_ceiling'] ?? $campaign->searchStrategies->search_wb_maximum_clicks_bid_ceiling,
                    'search_average_cpc_average_cpc' => $data['search_average_cpc_average_cpc'] ?? $campaign->searchStrategies->search_average_cpc_average_cpc,
                    'search_average_cpc_weekly_spend_limit' => $data['search_average_cpc_weekly_spend_limit'] ?? $campaign->searchStrategies->search_average_cpc_weekly_spend_limit,
                    'search_wb_maximum_conversion_rate_weekly_spend_limit' => $data['search_wb_maximum_conversion_rate_weekly_spend_limit'] ?? $campaign->searchStrategies->search_wb_maximum_conversion_rate_weekly_spend_limit,
                    'search_wb_maximum_conversion_rate_bid_ceiling' => $data['search_wb_maximum_conversion_rate_bid_ceiling'] ?? $campaign->searchStrategies->search_wb_maximum_conversion_rate_bid_ceiling,
                    'search_wb_maximum_conversion_rate_goal_id' => $data['search_wb_maximum_conversion_rate_goal_id'] ?? $campaign->searchStrategies->search_wb_maximum_conversion_rate_goal_id,
                    'search_average_cpa_weekly_spend_limit' => $data['search_average_cpa_weekly_spend_limit'] ?? $campaign->searchStrategies->search_average_cpa_weekly_spend_limit,
                    'search_average_cpa_bid_ceiling' => $data['search_average_cpa_bid_ceiling'] ?? $campaign->searchStrategies->search_average_cpa_bid_ceiling,
                    'search_average_cpa_exploration_budget' => $data['search_average_cpa_exploration_budget'] ?? $campaign->searchStrategies->search_average_cpa_exploration_budget,
                    'search_average_cpa_goal_id' => $data['search_average_cpa_goal_id'] ?? $campaign->searchStrategies->search_average_cpa_goal_id,
                    'search_average_cpa_average_cpa' => $data['search_average_cpa_average_cpa'] ?? $campaign->searchStrategies->search_average_cpa_average_cpa,
                    'search_average_cpa_multiple_goals_weekly_spend_limit' => $data['search_average_cpa_multiple_goals_weekly_spend_limit'] ?? $campaign->searchStrategies->search_average_cpa_multiple_goals_weekly_spend_limit,
                    'search_average_cpa_multiple_goals_bid_ceiling' => $data['search_average_cpa_multiple_goals_bid_ceiling'] ?? $campaign->searchStrategies->search_average_cpa_multiple_goals_bid_ceiling,
                    'search_average_cpa_multiple_goals_exploration_budget' => $data['search_average_cpa_multiple_goals_exploration_budget'] ?? $campaign->searchStrategies->search_average_cpa_multiple_goals_exploration_budget,
                    'search_average_cpa_multiple_goals_priority_goals' => $data['search_average_cpa_multiple_goals_priority_goals'] ?? $campaign->searchStrategies->search_average_cpa_multiple_goals_priority_goals,
                    'search_pay_for_conversion_weekly_spend_limit' => $data['search_pay_for_conversion_weekly_spend_limit'] ?? $campaign->searchStrategies->search_pay_for_conversion_weekly_spend_limit,
                    'search_pay_for_conversion_cpa' => $data['search_pay_for_conversion_cpa'] ?? $campaign->searchStrategies->search_pay_for_conversion_cpa,
                    'search_pay_for_conversion_goal_id' => $data['search_pay_for_conversion_goal_id'] ?? $campaign->searchStrategies->search_pay_for_conversion_goal_id,
                    'search_pay_for_conversion_multiple_goals_weekly_spend_limit' => $data['search_pay_for_conversion_multiple_goals_weekly_spend_limit'] ?? $campaign->searchStrategies->search_pay_for_conversion_multiple_goals_weekly_spend_limit,
                    'search_pay_for_conversion_multiple_goals_priority_goals' => $data['search_pay_for_conversion_multiple_goals_priority_goals'] ?? $campaign->searchStrategies->search_pay_for_conversion_multiple_goals_priority_goals,
                ]);
            }

            // 9. Обновляем настройки кампании (direct_campaign_settings)
            if ($campaign->settings) {
                $campaign->settings->update([
                    'tracking_params' => $data['tracking_params'] ?? $campaign->settings->tracking_params,
                    'attribution_model' => $data['attribution_model'] ?? $campaign->settings->attribution_model,
                    'add_metrica_tag' => $data['add_metrica_tag'] ?? $campaign->settings->add_metrica_tag,
                    'add_openstat_tag' => $data['add_openstat_tag'] ?? $campaign->settings->add_openstat_tag,
                    'add_to_favorites' => $data['add_to_favorites'] ?? $campaign->settings->add_to_favorites,
                    'campaign_exact_phrase_matching_enabled' => $data['campaign_exact_phrase_matching_enabled'] ?? $campaign->settings->campaign_exact_phrase_matching_enabled,
                    'enable_area_of_interest_targeting' => $data['enable_area_of_interest_targeting'] ?? $campaign->settings->enable_area_of_interest_targeting,
                    'enable_company_info' => $data['enable_company_info'] ?? $campaign->settings->enable_company_info,
                    'enable_extended_ad_title' => $data['enable_extended_ad_title'] ?? $campaign->settings->enable_extended_ad_title,
                    'enable_site_monitoring' => $data['enable_site_monitoring'] ?? $campaign->settings->enable_site_monitoring,
                    'exclude_paused_competing_ads' => $data['exclude_paused_competing_ads'] ?? $campaign->settings->exclude_paused_competing_ads,
                    'maintain_network_cpc' => $data['maintain_network_cpc'] ?? $campaign->settings->maintain_network_cpc,
                    'require_servicing' => $data['require_servicing'] ?? $campaign->settings->require_servicing,
                    'shared_account_enabled' => $data['shared_account_enabled'] ?? $campaign->settings->shared_account_enabled,
                    'alternative_texts_enabled' => $data['alternative_texts_enabled'] ?? $campaign->settings->alternative_texts_enabled,
                ]);
            }

            DB::commit();

            return back()->with('success', 'Настройки кампании успешно обновлены');

        } catch (\Exception $e) {
            DB::rollBack();

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