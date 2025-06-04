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
        return view('boss.direct-templates.campaigns.create', compact('template'));
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
            'strategy_type' => 'nullable|in:max_clicks,max_conversions,max_clicks_manual',
            'counter_ids' => 'nullable|array',
            'goals' => 'nullable|array',
            // Ограничения
            'weekly_spend_limit' => 'nullable|numeric|min:0',
            'average_cpc' => 'nullable|numeric|min:0',
            'average_cpa' => 'nullable|numeric|min:0',
            'average_crr' => 'nullable|numeric|min:0|max:100',
            'cpa' => 'nullable|numeric|min:0',
            'crr' => 'nullable|numeric|min:0|max:100'
        ]);

        $campaign = $template->campaigns()->create($validated);

        return redirect()->route('boss.direct-templates.edit', $template)
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
            'strategy_type' => 'nullable|in:max_clicks,max_conversions,max_clicks_manual',
            'counter_ids' => 'nullable|array',
            'goals' => 'nullable|array',
            // Ограничения
            'weekly_spend_limit' => 'nullable|numeric|min:0',
            'average_cpc' => 'nullable|numeric|min:0',
            'average_cpa' => 'nullable|numeric|min:0',
            'average_crr' => 'nullable|numeric|min:0|max:100',
            'cpa' => 'nullable|numeric|min:0',
            'crr' => 'nullable|numeric|min:0|max:100'
        ]);

        $campaign->update($validated);

        return redirect()->route('boss.direct-templates.edit', $template)
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

    public function limits(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        return view('boss.direct-templates.campaigns.limits', compact('template', 'campaign'));
    }

    public function additionalSettings(DirectTemplate $template, DirectTemplatesCampaign $campaign)
    {
        return view('boss.direct-templates.campaigns.additional-settings', compact('template', 'campaign'));
    }
} 