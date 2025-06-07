<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\AdGroup;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;

class AdGroupController extends Controller
{
    public function index(Campaign $campaign)
    {
        $adGroups = $campaign->adGroups()->paginate(10);
        return view('yandex-direct.campaigns.ad-groups.index', compact('campaign', 'adGroups'));
    }

    public function create(Campaign $campaign)
    {
        return view('yandex-direct.campaigns.ad-groups.create', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'type' => 'required|string',
            'settings' => 'required|array',
            'content' => 'required|array'
        ]);

        $adGroup = $campaign->adGroups()->create($validated);

        return redirect()
            ->route('yandex-direct.campaigns.ad-groups.edit', [$campaign, $adGroup])
            ->with('success', 'Группа объявлений успешно создана');
    }

    public function edit(Campaign $campaign, AdGroup $adGroup)
    {
        return view('yandex-direct.campaigns.ad-groups.edit', compact('campaign', 'adGroup'));
    }

    public function update(Request $request, Campaign $campaign, AdGroup $adGroup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'type' => 'required|string',
            'settings' => 'required|array',
            'content' => 'required|array'
        ]);

        $adGroup->update($validated);

        return redirect()
            ->route('yandex-direct.campaigns.ad-groups.edit', [$campaign, $adGroup])
            ->with('success', 'Группа объявлений успешно обновлена');
    }

    public function destroy(Campaign $campaign, AdGroup $adGroup)
    {
        $adGroup->delete();

        return redirect()
            ->route('yandex-direct.campaigns.ad-groups.index', $campaign)
            ->with('success', 'Группа объявлений успешно удалена');
    }
} 