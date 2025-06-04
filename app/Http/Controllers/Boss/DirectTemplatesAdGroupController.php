<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DirectTemplatesCampaign;
use App\Models\DirectTemplatesAdGroup;

class DirectTemplatesAdGroupController extends Controller
{
    public function index($campaignId)
    {
        $campaign = DirectTemplatesCampaign::findOrFail($campaignId);
        $adGroups = $campaign->adGroups()->latest()->paginate(10);
        return view('boss.direct-templates.ad-groups.index', compact('campaign', 'adGroups'));
    }

    public function create($campaignId)
    {
        $campaign = DirectTemplatesCampaign::findOrFail($campaignId);
        return view('boss.direct-templates.ad-groups.create', compact('campaign'));
    }

    public function store(Request $request, $campaignId)
    {
        $campaign = DirectTemplatesCampaign::findOrFail($campaignId);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'settings' => 'nullable|json',
            'targeting' => 'nullable|json',
        ]);
        $data['campaign_template_id'] = $campaign->id;
        DirectTemplatesAdGroup::create($data);
        return redirect()->route('boss.direct-templates.ad-groups.index', $campaign->id)->with('success', 'Группа объявлений создана');
    }

    public function edit($campaignId, $adGroupId)
    {
        $campaign = DirectTemplatesCampaign::findOrFail($campaignId);
        $adGroup = DirectTemplatesAdGroup::findOrFail($adGroupId);
        return view('boss.direct-templates.ad-groups.edit', compact('campaign', 'adGroup'));
    }

    public function update(Request $request, $campaignId, $adGroupId)
    {
        $campaign = DirectTemplatesCampaign::findOrFail($campaignId);
        $adGroup = DirectTemplatesAdGroup::findOrFail($adGroupId);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'settings' => 'nullable|json',
            'targeting' => 'nullable|json',
        ]);
        $adGroup->update($data);
        return redirect()->route('boss.direct-templates.ad-groups.index', $campaign->id)->with('success', 'Группа объявлений обновлена');
    }

    public function destroy($campaignId, $adGroupId)
    {
        $adGroup = DirectTemplatesAdGroup::findOrFail($adGroupId);
        $adGroup->delete();
        return redirect()->route('boss.direct-templates.ad-groups.index', $campaignId)->with('success', 'Группа объявлений удалена');
    }
} 