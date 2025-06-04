<?php

namespace App\Http\Controllers\Boss\DirectTemplates;

use App\Http\Controllers\Controller;
use App\Models\DirectTemplate;
use App\Models\DirectTemplateCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function create(DirectTemplate $template)
    {
        return view('boss.direct-templates.campaigns.create', compact('template'));
    }

    public function store(Request $request, DirectTemplate $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,paused,stopped',
            'url' => 'required|url',
            'metrika_counter_id' => 'required|string',
            'goal_ids' => 'required|array',
            'goal_ids.*' => 'required|string',
            'goal_values' => 'required_without:goal_prices|array',
            'goal_values.*' => 'required_with:goal_values|numeric|min:0',
            'goal_prices' => 'required_without:goal_values|array',
            'goal_prices.*' => 'required_with:goal_prices|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $campaign = $template->campaigns()->create([
                'name' => $validated['name'],
                'status' => $validated['status'],
                'url' => $validated['url'],
                'metrika_counter_id' => $validated['metrika_counter_id'],
                'goals' => $this->formatGoals($validated),
            ]);

            DB::commit();

            return redirect()
                ->route('boss.direct-templates.campaigns.edit', [$template, $campaign])
                ->with('success', 'Кампания успешно создана');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Произошла ошибка при создании кампании: ' . $e->getMessage());
        }
    }

    private function formatGoals($validated)
    {
        $goals = [];
        $goalIds = $validated['goal_ids'];
        $goalValues = $validated['goal_values'] ?? [];
        $goalPrices = $validated['goal_prices'] ?? [];

        foreach ($goalIds as $index => $goalId) {
            $goals[] = [
                'id' => $goalId,
                'value' => $goalValues[$index] ?? null,
                'price' => $goalPrices[$index] ?? null,
            ];
        }

        return $goals;
    }
} 