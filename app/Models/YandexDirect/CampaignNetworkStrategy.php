<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignNetworkStrategy extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaign_network_strategies';

    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'network_strategy_type',
        'network_wb_maximum_clicks_weekly_spend_limit',
        'network_wb_maximum_clicks_bid_ceiling',
        'network_average_cpc_average_cpc',
        'network_average_cpc_weekly_spend_limit',
        'network_wb_maximum_conversion_rate_weekly_spend_limit',
        'network_wb_maximum_conversion_rate_bid_ceiling',
        'network_wb_maximum_conversion_rate_goal_id',
        'network_average_cpa_weekly_spend_limit',
        'network_average_cpa_bid_ceiling',
        'network_average_cpa_exploration_budget',
        'network_average_cpa_goal_id',
        'network_average_cpa_average_cpa',
        'network_average_cpa_multiple_goals_weekly_spend_limit',
        'network_average_cpa_multiple_goals_bid_ceiling',
        'network_average_cpa_multiple_goals_exploration_budget',
        'network_average_cpa_multiple_goals_priority_goals',
        'network_pay_for_conversion_weekly_spend_limit',
        'network_pay_for_conversion_cpa',
        'network_pay_for_conversion_goal_id',
        'network_pay_for_conversion_multiple_goals_weekly_spend_limit',
        'network_pay_for_conversion_multiple_goals_priority_goals',
        'setting_param'
    ];

    protected $casts = [
        'network_strategy_type' => 'string',
        'network_wb_maximum_clicks_weekly_spend_limit' => 'decimal:6',
        'network_wb_maximum_clicks_bid_ceiling' => 'decimal:6',
        'network_average_cpc_average_cpc' => 'decimal:6',
        'network_average_cpc_weekly_spend_limit' => 'decimal:6',
        'network_wb_maximum_conversion_rate_weekly_spend_limit' => 'decimal:6',
        'network_wb_maximum_conversion_rate_bid_ceiling' => 'decimal:6',
        'network_average_cpa_weekly_spend_limit' => 'decimal:6',
        'network_average_cpa_bid_ceiling' => 'decimal:6',
        'network_average_cpa_exploration_budget' => 'array',
        'network_average_cpa_average_cpa' => 'decimal:6',
        'network_average_cpa_multiple_goals_weekly_spend_limit' => 'decimal:6',
        'network_average_cpa_multiple_goals_bid_ceiling' => 'decimal:6',
        'network_average_cpa_multiple_goals_exploration_budget' => 'array',
        'network_average_cpa_multiple_goals_priority_goals' => 'array',
        'network_pay_for_conversion_weekly_spend_limit' => 'decimal:6',
        'network_pay_for_conversion_cpa' => 'decimal:6',
        'network_pay_for_conversion_multiple_goals_weekly_spend_limit' => 'decimal:6',
        'network_pay_for_conversion_multiple_goals_priority_goals' => 'array',
        'setting_param' => 'array'
    ];

    /**
     * Получить кампанию, к которой относятся стратегии в сетях
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }
} 