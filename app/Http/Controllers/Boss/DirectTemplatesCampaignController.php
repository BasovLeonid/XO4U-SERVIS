<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\DirectTemplate;
use App\Models\DirectTemplatesCampaign;
use Illuminate\Http\Request;

class DirectTemplatesCampaignController extends Controller
{
    public function create(DirectTemplate $template)
    {
        // Создаем новую кампанию с минимальными данными
        $campaign = $template->campaigns()->create([
            'name' => 'Новая кампания',
            'status' => 'draft',
            'completed_sections' => []
        ]);

        // Перенаправляем на страницу настроек
        return redirect()->route('boss.direct-templates.campaigns.settings', [$template, $campaign]);
    }

    public function store(Request $request, DirectTemplate $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'daily_budget' => 'required|numeric|min:0',
            'status' => 'required|in:active,paused,stopped',
            // Дополнительные поля
            'placement_types' => 'nullable|array',
            'placement_types.*' => 'in:search,network,maps',
            'search_bidding_strategy_type' => 'nullable|in:max_clicks,max_conversions,max_clicks_manual',
            'network_bidding_strategy_type' => 'nullable|in:max_clicks,max_conversions,max_clicks_manual',
            'counter_ids' => 'nullable|array',
            'goals' => 'nullable|array',
            // Ограничения
            'weekly_spend_limit' => 'nullable|numeric|min:0',
            'average_cpc' => 'nullable|numeric|min:0',
            'average_cpa' => 'nullable|numeric|min:0',
            'average_crr' => 'nullable|numeric|min:0|max:100',
            'cpa' => 'nullable|numeric|min:0',
            'crr' => 'nullable|numeric|min:0|max:100',
            // Дополнительные настройки
            'time_targeting_schedule' => 'nullable|array',
            'time_targeting_schedule.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'consider_working_weekends' => 'nullable|in:YES,NO',
            'tracking_params' => 'nullable|string',
            'sms_settings' => 'nullable|array',
            'sms_settings.events' => 'nullable|array',
            'sms_settings.events.*' => 'in:CAMPAIGN_STOPPED,CAMPAIGN_ENDED',
            'email_settings' => 'nullable|array',
            'email_settings.events' => 'nullable|array',
            'email_settings.events.*' => 'in:CAMPAIGN_STOPPED,CAMPAIGN_ENDED',
            'negative_keywords' => 'nullable|array',
            'negative_keywords.*' => 'string',
            'blocked_ips' => 'nullable|array',
            'blocked_ips.*' => 'ip',
            'excluded_sites' => 'nullable|array',
            'excluded_sites.*' => 'url'
        ]);

        // Обработка списков
        if (isset($validated['negative_keywords'])) {
            $validated['negative_keywords'] = array_filter(explode("\n", $validated['negative_keywords'][0]));
        }
        if (isset($validated['blocked_ips'])) {
            $validated['blocked_ips'] = array_filter(explode("\n", $validated['blocked_ips'][0]));
        }
        if (isset($validated['excluded_sites'])) {
            $validated['excluded_sites'] = array_filter(explode("\n", $validated['excluded_sites'][0]));
        }

        $campaign = $template->campaigns()->create($validated);

        return redirect()->route('boss.direct-templates.campaigns.settings', [$template, $campaign])
            ->with('success', 'Кампания успешно создана');
    }

    public function edit(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        // Здесь можно добавить загрузку счетчиков и целей из Яндекс.Метрики
        $counters = []; // Загрузка счетчиков
        $goals = []; // Загрузка целей

        return view('boss.direct-templates.campaigns.edit', compact('template', 'campaign', 'counters', 'goals'));
    }

    public function update(Request $request, DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'daily_budget' => 'required|numeric|min:0',
            'status' => 'required|in:active,paused,stopped',
            // Дополнительные поля
            'placement_types' => 'nullable|array',
            'placement_types.*' => 'in:search,network,maps',
            'search_bidding_strategy_type' => 'nullable|in:max_clicks,max_conversions,max_clicks_manual',
            'network_bidding_strategy_type' => 'nullable|in:max_clicks,max_conversions,max_clicks_manual',
            'counter_ids' => 'nullable|array',
            'goals' => 'nullable|array',
            // Ограничения
            'weekly_spend_limit' => 'nullable|numeric|min:0',
            'average_cpc' => 'nullable|numeric|min:0',
            'average_cpa' => 'nullable|numeric|min:0',
            'average_crr' => 'nullable|numeric|min:0|max:100',
            'cpa' => 'nullable|numeric|min:0',
            'crr' => 'nullable|numeric|min:0|max:100',
            // Дополнительные настройки
            'time_targeting_schedule' => 'nullable|array',
            'time_targeting_schedule.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'consider_working_weekends' => 'nullable|in:YES,NO',
            'tracking_params' => 'nullable|string',
            'sms_settings' => 'nullable|array',
            'sms_settings.events' => 'nullable|array',
            'sms_settings.events.*' => 'in:CAMPAIGN_STOPPED,CAMPAIGN_ENDED',
            'email_settings' => 'nullable|array',
            'email_settings.events' => 'nullable|array',
            'email_settings.events.*' => 'in:CAMPAIGN_STOPPED,CAMPAIGN_ENDED',
            'negative_keywords' => 'nullable|array',
            'negative_keywords.*' => 'string',
            'blocked_ips' => 'nullable|array',
            'blocked_ips.*' => 'ip',
            'excluded_sites' => 'nullable|array',
            'excluded_sites.*' => 'url'
        ]);

        // Обработка списков
        if (isset($validated['negative_keywords'])) {
            $validated['negative_keywords'] = array_filter(explode("\n", $validated['negative_keywords'][0]));
        }
        if (isset($validated['blocked_ips'])) {
            $validated['blocked_ips'] = array_filter(explode("\n", $validated['blocked_ips'][0]));
        }
        if (isset($validated['excluded_sites'])) {
            $validated['excluded_sites'] = array_filter(explode("\n", $validated['excluded_sites'][0]));
        }

        $campaign->update($validated);

        return redirect()->route('boss.direct-templates.campaigns.settings', [$template, $campaign])
            ->with('success', 'Кампания успешно обновлена');
    }

    public function destroy(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('boss.direct-templates.edit', $template)
            ->with('success', 'Кампания успешно удалена');
    }

    public function settings(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        // Здесь можно добавить загрузку счетчиков и целей из Яндекс.Метрики
        $counters = []; // Загрузка счетчиков
        $goals = []; // Загрузка целей

        return view('boss.direct-templates.campaigns.settings', compact('template', 'campaign', 'counters', 'goals'));
    }

    public function schedule(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        return view('boss.direct-templates.campaigns.schedule', compact('template', 'campaign'));
    }

    public function additionalSettings(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        return view('boss.direct-templates.campaigns.additional-settings', compact('template', 'campaign'));
    }

    public function corrections(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        return view('boss.direct-templates.campaigns.corrections', compact('template', 'campaign'));
    }

    public function restrictions(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        return view('boss.direct-templates.campaigns.restrictions', compact('template', 'campaign'));
    }

    public function updateSection(Request $request, DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        $section = $request->input('section');
        $isCompleted = $request->input('completed', false);

        $completedSections = $campaign->completed_sections ?? [];
        
        if ($isCompleted) {
            if (!in_array($section, $completedSections)) {
                $completedSections[] = $section;
            }
        } else {
            $completedSections = array_diff($completedSections, [$section]);
        }

        $campaign->update([
            'completed_sections' => $completedSections
        ]);

        return response()->json([
            'success' => true,
            'completed_sections' => $completedSections
        ]);
    }
} 