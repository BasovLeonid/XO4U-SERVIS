<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\DirectTemplate;
use App\Models\DirectTemplatesCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectTemplateController extends Controller
{
    public function index()
    {
        $templates = DirectTemplate::with('campaigns')->get();
        return view('boss.direct-templates.index', compact('templates'));
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
        $template = $direct_template->load('campaigns');
        return view('boss.direct-templates.edit', compact('template'));
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