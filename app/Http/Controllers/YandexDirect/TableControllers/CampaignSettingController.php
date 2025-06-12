<?php

namespace App\Http\Controllers\YandexDirect\TableControllers;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CampaignSettingController extends Controller
{
    /**
     * Обновить настройки кампании
     */
    public function update(Request $request, $campaignId): JsonResponse
    {
        $campaign = Campaign::findOrFail($campaignId);
        
        $validator = Validator::make($request->all(), [
            'tracking_params' => 'nullable|array',
            'attribution_model' => 'required|in:LAST_CLICK,FIRST_CLICK,LINEAR',
            'add_metrica_tag' => 'required|boolean',
            'add_openstat_tag' => 'required|boolean',
            'add_to_favorites' => 'required|boolean',
            'campaign_exact_phrase_matching_enabled' => 'required|boolean',
            'enable_area_of_interest_targeting' => 'required|boolean',
            'enable_company_info' => 'required|boolean',
            'enable_extended_ad_title' => 'required|boolean',
            'enable_site_monitoring' => 'required|boolean',
            'exclude_paused_competing_ads' => 'required|boolean',
            'maintain_network_cpc' => 'required|boolean',
            'require_servicing' => 'required|boolean',
            'shared_account_enabled' => 'required|boolean',
            'alternative_texts_enabled' => 'required|boolean',
            'setting_param' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $settings = $campaign->settings()->updateOrCreate(
            ['direct_campaign_id' => $campaign->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Настройки успешно обновлены',
            'data' => $settings
        ]);
    }
} 