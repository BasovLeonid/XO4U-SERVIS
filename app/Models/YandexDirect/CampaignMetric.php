<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignMetric extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaign_metrics';

    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'counter_ids',
        'primary_counter_id',
        'priority_goals',
        'primary_goal_id',
        'primary_goal_value',
        'setting_param'
    ];

    protected $casts = [
        'counter_ids' => 'array',
        'priority_goals' => 'array',
        'primary_goal_value' => 'decimal:6',
        'setting_param' => 'array'
    ];

    /**
     * Получить кампанию, к которой относятся метрики
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }
} 