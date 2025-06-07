<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DirectTemplatesCampaign extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'template_id',
        'name',
        'status',
        'url',
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
        'consider_working_weekends',
        'holidays_schedule',
        'campaign_type',
        'search_bidding_strategy',
        'search_bidding_strategy_type',
        'search_placement_types',
        'network_bidding_strategy',
        'network_bidding_strategy_type',
        'network_placement_types',
        'campaign_settings',
        'campaign_settings_option',
        'counter_ids',
        'priority_goals',
        'tracking_params',
        'attribution_model',
        'package_bidding_strategy',
        'package_bidding_platforms',
        'negative_keyword_shared_set_ids',
        'platforms',
        'weekly_budget',
        'max_clicks_average_cpc',
        'completed_sections'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'daily_budget_amount' => 'decimal:2',
        'weekly_budget' => 'decimal:2',
        'max_clicks_average_cpc' => 'decimal:2',
        'sms_settings' => 'array',
        'email_settings' => 'array',
        'negative_keywords' => 'array',
        'blocked_ips' => 'array',
        'excluded_sites' => 'array',
        'time_targeting_schedule' => 'array',
        'holidays_schedule' => 'array',
        'search_bidding_strategy' => 'array',
        'search_placement_types' => 'array',
        'network_bidding_strategy' => 'array',
        'network_placement_types' => 'array',
        'campaign_settings' => 'array',
        'counter_ids' => 'array',
        'priority_goals' => 'array',
        'package_bidding_strategy' => 'array',
        'package_bidding_platforms' => 'array',
        'negative_keyword_shared_set_ids' => 'array',
        'platforms' => 'array',
        'completed_sections' => 'array'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string>
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * Get the template that owns the campaign.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(DirectTemplate::class, 'template_id');
    }

    /**
     * Get the ad groups for the campaign.
     */
    public function adGroups(): HasMany
    {
        return $this->hasMany(DirectTemplatesAdGroup::class, 'campaign_template_id');
    }

    /**
     * Get the ad extensions for the campaign.
     */
    public function adExtensions(): HasMany
    {
        return $this->hasMany(DirectTemplatesAdExtension::class, 'campaign_template_id');
    }

    /**
     * Get the audiences for the campaign.
     */
    public function audiences(): HasMany
    {
        return $this->hasMany(DirectTemplatesAudience::class, 'campaign_template_id');
    }

    /**
     * Get the feeds for the campaign.
     */
    public function feeds(): HasMany
    {
        return $this->hasMany(DirectTemplatesFeed::class, 'campaign_template_id');
    }

    /**
     * Scope a query to only include active campaigns.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include campaigns with a specific type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('campaign_type', $type);
    }

    /**
     * Scope a query to only include campaigns with a specific bidding strategy type.
     */
    public function scopeWithSearchBiddingStrategyType($query, $type)
    {
        return $query->where('search_bidding_strategy_type', $type);
    }

    /**
     * Scope a query to only include campaigns with a specific network bidding strategy type.
     */
    public function scopeWithNetworkBiddingStrategyType($query, $type)
    {
        return $query->where('network_bidding_strategy_type', $type);
    }
} 