<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\DirectTemplate;
use App\Models\YandexDirect\DirectCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DirectTemplateController extends Controller
{
    public function index()
    {
        $templates = DirectTemplate::select('direct_templates.*')
            ->leftJoin('direct_campaigns', 'direct_templates.id', '=', 'direct_campaigns.template_id')
            ->select('direct_templates.*', DB::raw('COUNT(direct_campaigns.id) as campaigns_count'))
            ->groupBy('direct_templates.id')
            ->get();

        $campaigns = DirectCampaign::whereIn('template_id', $templates->pluck('id'))->get();
        
        return view('boss.direct-templates.index', compact('templates', 'campaigns'));
    }

    public function create()
    {
        return view('boss.direct-templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'types' => 'required|array',
            'types.*' => 'in:search,network,maps',
            'strategy' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('templates', 'public');
        }

        DirectTemplate::create($validated);

        return redirect()->route('boss.direct-templates.index')
            ->with('success', 'Шаблон успешно создан');
    }

    public function edit(DirectTemplate $direct_template)
    {
        return view('boss.direct-templates.edit', compact('direct_template'));
    }

    public function update(Request $request, DirectTemplate $direct_template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'types' => 'required|array',
            'types.*' => 'in:search,network,maps',
            'strategy' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($direct_template->image) {
                Storage::disk('public')->delete($direct_template->image);
            }
            $validated['image'] = $request->file('image')->store('templates', 'public');
        }

        $direct_template->update($validated);

        return redirect()->route('boss.direct-templates.index')
            ->with('success', 'Шаблон успешно обновлен');
    }

    public function destroy(DirectTemplate $direct_template)
    {
        if (DirectCampaign::where('template_id', $direct_template->id)->exists()) {
            return redirect()->route('boss.direct-templates.index')
                ->with('error', 'Невозможно удалить шаблон, так как в нем есть кампании. Сначала удалите все кампании.');
        }

        if ($direct_template->image) {
            Storage::disk('public')->delete($direct_template->image);
        }
        
        $direct_template->delete();

        return redirect()->route('boss.direct-templates.index')
            ->with('success', 'Шаблон успешно удален');
    }

    public function additionalSettings(Request $request)
    {
        $strategyType = $request->input('strategy_type');
        $placementTypes = $request->input('placement_types', []);

        return view('boss.direct-templates.partials.additional-settings', compact('strategyType', 'placementTypes'));
    }
} 