<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;

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

    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'type' => 'required|string',
            'settings' => 'required|array',
            'content' => 'required|array'
        ]);

        $campaign->update($validated);

        return redirect()
            ->route('yandex-direct.campaigns.edit', $campaign)
            ->with('success', 'Кампания успешно обновлена');
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