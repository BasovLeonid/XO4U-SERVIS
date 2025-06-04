<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectTemplatesAdGroup;
use App\Models\DirectTemplatesAd;

class DirectTemplatesAdController extends Controller
{
    public function index($campaignId, $adGroupId)
    {
        $adGroup = DirectTemplatesAdGroup::findOrFail($adGroupId);
        $ads = $adGroup->ads()->latest()->paginate(10);
        return view('boss.direct-templates.ads.index', compact('adGroup', 'ads', 'campaignId'));
    }

    public function create($campaignId, $adGroupId)
    {
        $adGroup = DirectTemplatesAdGroup::findOrFail($adGroupId);
        return view('boss.direct-templates.ads.create', compact('adGroup', 'campaignId'));
    }

    public function store(Request $request, $campaignId, $adGroupId)
    {
        $adGroup = DirectTemplatesAdGroup::findOrFail($adGroupId);
        $data = $request->validate([
            'type' => 'required|string',
            'content' => 'required|json',
            'settings' => 'nullable|json',
        ]);
        $data['ad_group_template_id'] = $adGroup->id;
        DirectTemplatesAd::create($data);
        return redirect()->route('boss.direct-templates.ads.index', [$campaignId, $adGroup->id])->with('success', 'Объявление создано');
    }

    public function edit($campaignId, $adGroupId, $adId)
    {
        $adGroup = DirectTemplatesAdGroup::findOrFail($adGroupId);
        $ad = DirectTemplatesAd::findOrFail($adId);
        return view('boss.direct-templates.ads.edit', compact('adGroup', 'ad', 'campaignId'));
    }

    public function update(Request $request, $campaignId, $adGroupId, $adId)
    {
        $ad = DirectTemplatesAd::findOrFail($adId);
        $data = $request->validate([
            'type' => 'required|string',
            'content' => 'required|json',
            'settings' => 'nullable|json',
        ]);
        $ad->update($data);
        return redirect()->route('boss.direct-templates.ads.index', [$campaignId, $adGroupId])->with('success', 'Объявление обновлено');
    }

    public function destroy($campaignId, $adGroupId, $adId)
    {
        $ad = DirectTemplatesAd::findOrFail($adId);
        $ad->delete();
        return redirect()->route('boss.direct-templates.ads.index', [$campaignId, $adGroupId])->with('success', 'Объявление удалено');
    }
} 