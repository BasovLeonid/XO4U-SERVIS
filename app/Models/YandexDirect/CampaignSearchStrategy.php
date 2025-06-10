<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignSearchStrategy extends Model
{
    use SoftDeletes;

    /**
     * Таблица, связанная с моделью
     *
     * @var string
     */
    protected $table = 'direct_campaign_search_strategies';

    /**
     * Атрибуты, которые можно массово присваивать
     *
     * @var array
     */
    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'search_strategy_type',
        'search_wb_maximum_clicks_weekly_spend_limit',
        'search_wb_maximum_clicks_bid_ceiling',
        'search_average_cpc_average_cpc',
        'search_average_cpc_weekly_spend_limit',
        'search_wb_maximum_conversion_rate_weekly_spend_limit',
        'search_wb_maximum_conversion_rate_bid_ceiling',
        'search_wb_maximum_conversion_rate_goal_id',
        'search_average_cpa_weekly_spend_limit',
        'search_average_cpa_bid_ceiling',
        'search_average_cpa_exploration_budget',
        'search_average_cpa_goal_id',
        'search_average_cpa_average_cpa',
        'search_average_cpa_multiple_goals_weekly_spend_limit',
        'search_average_cpa_multiple_goals_bid_ceiling',
        'search_average_cpa_multiple_goals_exploration_budget',
        'search_average_cpa_multiple_goals_priority_goals',
        'search_pay_for_conversion_weekly_spend_limit',
        'search_pay_for_conversion_cpa',
        'search_pay_for_conversion_goal_id',
        'search_pay_for_conversion_multiple_goals_weekly_spend_limit',
        'search_pay_for_conversion_multiple_goals_priority_goals',
        'setting_param'
    ];

    /**
     * Атрибуты, которые должны быть приведены к нативным типам
     *
     * @var array
     */
    protected $casts = [
        'search_average_cpa_exploration_budget' => 'json',
        'search_average_cpa_multiple_goals_exploration_budget' => 'json',
        'search_average_cpa_multiple_goals_priority_goals' => 'json',
        'search_pay_for_conversion_multiple_goals_priority_goals' => 'json',
        'setting_param' => 'json',
        'search_wb_maximum_clicks_weekly_spend_limit' => 'decimal:6',
        'search_wb_maximum_clicks_bid_ceiling' => 'decimal:6',
        'search_average_cpc_average_cpc' => 'decimal:6',
        'search_average_cpc_weekly_spend_limit' => 'decimal:6',
        'search_wb_maximum_conversion_rate_weekly_spend_limit' => 'decimal:6',
        'search_wb_maximum_conversion_rate_bid_ceiling' => 'decimal:6',
        'search_average_cpa_weekly_spend_limit' => 'decimal:6',
        'search_average_cpa_bid_ceiling' => 'decimal:6',
        'search_average_cpa_average_cpa' => 'decimal:6',
        'search_average_cpa_multiple_goals_weekly_spend_limit' => 'decimal:6',
        'search_average_cpa_multiple_goals_bid_ceiling' => 'decimal:6',
        'search_pay_for_conversion_weekly_spend_limit' => 'decimal:6',
        'search_pay_for_conversion_cpa' => 'decimal:6',
        'search_pay_for_conversion_multiple_goals_weekly_spend_limit' => 'decimal:6'
    ];

    /**
     * Получить кампанию, которой принадлежит стратегия
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }

    /**
     * Получить допустимые типы стратегий
     *
     * @return array
     */
    public static function getStrategyTypes(): array
    {
        return [
            'HIGHEST_POSITION',
            'WB_MAXIMUM_CLICKS',
            'AVERAGE_CPC',
            'WB_MAXIMUM_CONVERSION_RATE',
            'AVERAGE_CPA',
            'PAY_FOR_CONVERSION'
        ];
    }
} 