<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignSetting extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaign_settings';

    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'tracking_params',
        'attribution_model',
        'add_metrica_tag',
        'add_openstat_tag',
        'add_to_favorites',
        'campaign_exact_phrase_matching_enabled',
        'enable_area_of_interest_targeting',
        'enable_company_info',
        'enable_extended_ad_title',
        'enable_site_monitoring',
        'exclude_paused_competing_ads',
        'maintain_network_cpc',
        'require_servicing',
        'shared_account_enabled',
        'alternative_texts_enabled',
        'setting_param'
    ];

    protected $casts = [
        'add_metrica_tag' => 'boolean',
        'add_openstat_tag' => 'boolean',
        'add_to_favorites' => 'boolean',
        'campaign_exact_phrase_matching_enabled' => 'boolean',
        'enable_area_of_interest_targeting' => 'boolean',
        'enable_company_info' => 'boolean',
        'enable_extended_ad_title' => 'boolean',
        'enable_site_monitoring' => 'boolean',
        'exclude_paused_competing_ads' => 'boolean',
        'maintain_network_cpc' => 'boolean',
        'require_servicing' => 'boolean',
        'shared_account_enabled' => 'boolean',
        'alternative_texts_enabled' => 'boolean',
        'setting_param' => 'array'
    ];

    /**
     * Получить кампанию, к которой относятся настройки
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }
} 