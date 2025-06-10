<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaign_schedules';

    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'start_date',
        'end_date',
        'time_zone',
        'time_targeting_type',
        'time_targeting_custom',
        'time_targeting_budni',
        'time_targeting_set1',
        'time_targeting_set2',
        'time_targeting_set3',
        'consider_working_weekends',
        'holidays_schedule',
        'setting_param'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'time_targeting_custom' => 'array',
        'time_targeting_budni' => 'array',
        'time_targeting_set1' => 'array',
        'time_targeting_set2' => 'array',
        'time_targeting_set3' => 'array',
        'holidays_schedule' => 'array',
        'setting_param' => 'array'
    ];

    /**
     * Получить кампанию, к которой относится расписание
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }
} 