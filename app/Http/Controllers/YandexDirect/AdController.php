<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Ad;
use App\Models\YandexDirect\AdGroup;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Campaign $campaign, AdGroup $adGroup)
    {
        $ads = $adGroup->ads()->paginate(10);
        return view('yandex-direct.campaigns.ads.index', compact('campaign', 'adGroup', 'ads'));
    }

    public function create(Campaign $campaign, AdGroup $adGroup)
    {
        return view('yandex-direct.campaigns.ads.create', compact('campaign', 'adGroup'));
    }

    public function store(Request $request, Campaign $campaign, AdGroup $adGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'type' => 'required|string',
            'settings' => 'required|array',
            'content' => 'required|array'
        ]);

        $ad = $adGroup->ads()->create($validated);

        return redirect()
            ->route('yandex-direct.campaigns.ads.edit', [$campaign, $adGroup, $ad])
            ->with('success', 'Объявление успешно создано');
    }

    public function edit(Campaign $campaign, AdGroup $adGroup, Ad $ad)
    {
        return view('yandex-direct.campaigns.ads.edit', compact('campaign', 'adGroup', 'ad'));
    }

    public function update(Request $request, Campaign $campaign, AdGroup $adGroup, Ad $ad)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'type' => 'required|string',
            'settings' => 'required|array',
            'content' => 'required|array'
        ]);

        $ad->update($validated);

        return redirect()
            ->route('yandex-direct.campaigns.ads.edit', [$campaign, $adGroup, $ad])
            ->with('success', 'Объявление успешно обновлено');
    }

    public function destroy(Campaign $campaign, AdGroup $adGroup, Ad $ad)
    {
        $ad->delete();

        return redirect()
            ->route('yandex-direct.campaigns.ads.index', [$campaign, $adGroup])
            ->with('success', 'Объявление успешно удалено');
    }
} 