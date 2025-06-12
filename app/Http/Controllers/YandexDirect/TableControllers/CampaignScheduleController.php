<?php

namespace App\Http\Controllers\YandexDirect\TableControllers;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CampaignScheduleController extends Controller
{
    /**
     * Обновить расписание
     */
    public function update(Request $request, $campaignId): JsonResponse
    {
        $campaign = Campaign::findOrFail($campaignId);
        
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'time_zone' => 'required|string|max:50',
            'time_targeting_type' => 'required|in:custom,budni,set1,set2,set3',
            'time_targeting_custom' => 'nullable|array',
            'time_targeting_budni' => 'nullable|array',
            'time_targeting_set1' => 'nullable|array',
            'time_targeting_set2' => 'nullable|array',
            'time_targeting_set3' => 'nullable|array',
            'consider_working_weekends' => 'required|in:YES,NO',
            'holidays_schedule' => 'nullable|array',
            'setting_param' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $schedule = $campaign->schedule()->updateOrCreate(
            ['direct_campaign_id' => $campaign->id],
            $request->all()
        );

        return response()->json([
            'success' => true,
            'message' => 'Расписание успешно обновлено',
            'data' => $schedule
        ]);
    }
} 