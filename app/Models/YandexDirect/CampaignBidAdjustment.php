<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignBidAdjustment extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaign_bid_adjustments';

    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'yandex_ad_group_id',
        'mobile_adjustment',
        'tablet_adjustment',
        'desktop_adjustment',
        'desktop_only_adjustment',
        'demographics_adjustments',
        'retargeting_adjustments',
        'regional_adjustments',
        'video_adjustment',
        'smart_ad_adjustment',
        'serp_layout_adjustments',
        'income_grade_adjustments',
        'ad_group_adjustment',
        'setting_param'
    ];

    protected $casts = [
        'mobile_adjustment' => 'array',
        'tablet_adjustment' => 'array',
        'desktop_adjustment' => 'array',
        'desktop_only_adjustment' => 'array',
        'demographics_adjustments' => 'array',
        'retargeting_adjustments' => 'array',
        'regional_adjustments' => 'array',
        'video_adjustment' => 'array',
        'smart_ad_adjustment' => 'array',
        'serp_layout_adjustments' => 'array',
        'income_grade_adjustments' => 'array',
        'ad_group_adjustment' => 'array',
        'setting_param' => 'array'
    ];

    /**
     * Получить кампанию, к которой относятся корректировки
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }
} 