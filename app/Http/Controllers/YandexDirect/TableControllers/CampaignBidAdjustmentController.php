<?php

namespace App\Http\Controllers\YandexDirect\TableControllers;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CampaignBidAdjustmentController extends Controller
{
    /**
     * Обновить корректировки ставок
     */
    public function update(Request $request, $campaignId): JsonResponse
    {
        $campaign = Campaign::findOrFail($campaignId);
        
        $validator = Validator::make($request->all(), [
            'mobile_adjustment' => 'required|numeric|min:-100|max:100',
            'tablet_adjustment' => 'required|numeric|min:-100|max:100',
            'desktop_adjustment' => 'required|numeric|min:-100|max:100',
            'desktop_only_adjustment' => 'required|numeric|min:-100|max:100',
            'demographics_adjustments' => 'nullable|array',
            'retargeting_adjustments' => 'nullable|array',
            'regional_adjustments' => 'nullable|array',
            'video_adjustment' => 'required|numeric|min:-100|max:100',
            'smart_ad_adjustment' => 'required|numeric|min:-100|max:100',
            'serp_layout_adjustments' => 'nullable|array',
            'income_grade_adjustments' => 'nullable|array',
            'ad_group_adjustment' => 'required|numeric|min:-100|max:100',
            'setting_param' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $bidAdjustments = $campaign->bidAdjustments()->updateOrCreate(
            ['direct_campaign_id' => $campaign->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Корректировки ставок успешно обновлены',
            'data' => $bidAdjustments
        ]);
    }
} 