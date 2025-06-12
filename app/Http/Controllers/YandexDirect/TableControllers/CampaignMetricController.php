<?php

namespace App\Http\Controllers\YandexDirect\TableControllers;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CampaignMetricController extends Controller
{
    /**
     * Обновить метрики
     */
    public function update(Request $request, $campaignId): JsonResponse
    {
        $campaign = Campaign::findOrFail($campaignId);
        
        $validator = Validator::make($request->all(), [
            'counter_ids' => 'nullable|array',
            'primary_counter_id' => 'nullable|integer',
            'priority_goals' => 'nullable|array',
            'primary_goal_id' => 'nullable|integer',
            'primary_goal_value' => 'nullable|numeric|min:0',
            'setting_param' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $metrics = $campaign->metrics()->updateOrCreate(
            ['direct_campaign_id' => $campaign->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Метрики успешно обновлены',
            'data' => $metrics
        ]);
    }
} 