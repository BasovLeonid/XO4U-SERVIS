<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectTemplateCampaign extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'url',
        'metrika_counter_id',
        'goals',
        'template_id',
        'client_info',
        'time_zone',
        'start_date',
        'end_date',
        'daily_budget_amount',
        'daily_budget_mode',
        'sms_settings',
        'email_settings',
        'negative_keywords',
        'blocked_ips',
        'excluded_sites',
        'time_targeting_schedule',
        'campaign_settings',
        'campaign_settings_option',
        'counter_ids',
        'priority_goals',
        'tracking_params',
        'attribution_model',
        'package_bidding_strategy',
        'package_bidding_platforms',
        'negative_keyword_shared_set_ids'
    ];

    protected $casts = [
        'goals' => 'array',
        'sms_settings' => 'array',
        'email_settings' => 'array',
        'negative_keywords' => 'array',
        'blocked_ips' => 'array',
        'excluded_sites' => 'array',
        'time_targeting_schedule' => 'array',
        'campaign_settings' => 'array',
        'counter_ids' => 'array',
        'priority_goals' => 'array',
        'package_bidding_strategy' => 'array',
        'package_bidding_platforms' => 'array',
        'negative_keyword_shared_set_ids' => 'array',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function adGroups(): HasMany
    {
        return $this->hasMany(DirectTemplateAdGroup::class, 'campaign_template_id');
    }

    public function adExtensions(): HasMany
    {
        return $this->hasMany(DirectTemplateAdExtension::class, 'campaign_template_id');
    }

    public function audiences(): HasMany
    {
        return $this->hasMany(DirectTemplateAudience::class, 'campaign_template_id');
    }

    public function feeds(): HasMany
    {
        return $this->hasMany(DirectTemplateFeed::class, 'campaign_template_id');
    }

    public function template()
    {
        return $this->belongsTo(DirectTemplate::class, 'template_id');
    }
} 