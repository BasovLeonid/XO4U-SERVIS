<?php

namespace App\Http\Controllers\YandexDirect\TableControllers;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CampaignSearchStrategyController extends Controller
{
    /**
     * Обновить поисковые стратегии
     */
    public function update(Request $request, $campaignId): JsonResponse
    {
        $campaign = Campaign::findOrFail($campaignId);
        
        $validator = Validator::make($request->all(), [
            'search_strategy_type' => 'required|in:MAXIMUM_CLICKS,AVERAGE_CPC,MAXIMUM_CONVERSION_RATE,AVERAGE_CPA,PAY_FOR_CONVERSION',
            'search_wb_maximum_clicks_weekly_spend_limit' => 'nullable|numeric|min:0',
            'search_wb_maximum_clicks_bid_ceiling' => 'nullable|numeric|min:0',
            'search_average_cpc_average_cpc' => 'nullable|numeric|min:0',
            'search_average_cpc_weekly_spend_limit' => 'nullable|numeric|min:0',
            'search_wb_maximum_conversion_rate_weekly_spend_limit' => 'nullable|numeric|min:0',
            'search_wb_maximum_conversion_rate_bid_ceiling' => 'nullable|numeric|min:0',
            'search_wb_maximum_conversion_rate_goal_id' => 'nullable|integer',
            'search_average_cpa_weekly_spend_limit' => 'nullable|numeric|min:0',
            'search_average_cpa_bid_ceiling' => 'nullable|numeric|min:0',
            'search_average_cpa_exploration_budget' => 'nullable|numeric|min:0',
            'search_average_cpa_goal_id' => 'nullable|integer',
            'search_average_cpa_average_cpa' => 'nullable|numeric|min:0',
            'search_average_cpa_multiple_goals_weekly_spend_limit' => 'nullable|numeric|min:0',
            'search_average_cpa_multiple_goals_bid_ceiling' => 'nullable|numeric|min:0',
            'search_average_cpa_multiple_goals_exploration_budget' => 'nullable|numeric|min:0',
            'search_average_cpa_multiple_goals_priority_goals' => 'nullable|array',
            'search_pay_for_conversion_weekly_spend_limit' => 'nullable|numeric|min:0',
            'search_pay_for_conversion_cpa' => 'nullable|numeric|min:0',
            'search_pay_for_conversion_goal_id' => 'nullable|integer',
            'search_pay_for_conversion_multiple_goals_weekly_spend_limit' => 'nullable|numeric|min:0',
            'search_pay_for_conversion_multiple_goals_priority_goals' => 'nullable|array',
            'setting_param' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $searchStrategies = $campaign->searchStrategies()->updateOrCreate(
            ['direct_campaign_id' => $campaign->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Поисковые стратегии успешно обновлены',
            'data' => $searchStrategies
        ]);
    }
} 