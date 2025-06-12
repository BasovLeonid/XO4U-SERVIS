<?php

namespace App\Http\Controllers\YandexDirect\TableControllers;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CampaignExclusionController extends Controller
{
    /**
     * Обновить исключения
     */
    public function update(Request $request, $campaignId): JsonResponse
    {
        $campaign = Campaign::findOrFail($campaignId);
        
        $validator = Validator::make($request->all(), [
            'blocked_ips' => 'nullable|array',
            'excluded_sites' => 'nullable|array',
            'setting_param' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $exclusions = $campaign->exclusions()->updateOrCreate(
            ['direct_campaign_id' => $campaign->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Исключения успешно обновлены',
            'data' => $exclusions
        ]);
    }
} 