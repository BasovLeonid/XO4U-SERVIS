<?php

namespace App\Http\Controllers\YandexDirect\TableControllers;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CampaignBasicController extends Controller
{
    /**
     * Обновить базовые настройки кампании
     */
    public function update(Request $request, $campaignId): JsonResponse
    {
        $campaign = Campaign::findOrFail($campaignId);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,paused,draft',
            'url' => 'required|url|max:2048',
            'daily_budget_amount' => 'required|numeric|min:0',
            'daily_budget_mode' => 'required|in:standard,extended',
            'search_result' => 'required|boolean',
            'dynamic_places' => 'required|boolean',
            'product_gallery' => 'required|boolean',
            'search_organization_list' => 'required|boolean',
            'network' => 'required|boolean',
            'maps' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $campaign->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Базовые настройки успешно обновлены',
            'data' => $campaign
        ]);
    }
} 