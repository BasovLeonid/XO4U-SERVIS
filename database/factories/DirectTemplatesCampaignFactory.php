<?php

namespace Database\Factories;

use App\Models\DirectTemplatesCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class DirectTemplatesCampaignFactory extends Factory
{
    protected $model = DirectTemplatesCampaign::class;

    public function definition(): array
    {
        return [
            'template_id' => 1, // ID вашего шаблона
            'name' => $this->faker->company . ' Campaign',
            'status' => 'active',
            'url' => $this->faker->url,
            'client_info' => $this->faker->company,
            'time_zone' => 'Europe/Moscow',
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'daily_budget_amount' => $this->faker->randomFloat(2, 100, 1000),
            'daily_budget_mode' => 'STANDARD',
            'weekly_budget' => $this->faker->randomFloat(2, 1000, 5000),
            'max_clicks_average_cpc' => $this->faker->randomFloat(2, 10, 100),
            'platforms' => [
                'ProductGallery' => 'YES',
                'SearchResult' => 'YES',
                'DynamicPlaces' => 'YES',
                'SearchOrganizationList' => 'YES',
                'Network' => 'YES',
                'Maps' => 'YES'
            ],
            'search_bidding_strategy_type' => 'WB_MAXIMUM_CLICKS',
            'search_bidding_strategy' => [
                'WeeklySpendLimit' => $this->faker->randomFloat(2, 1000, 5000),
                'AverageCpc' => $this->faker->randomFloat(2, 10, 100)
            ],
            'search_placement_types' => ['SearchResults', 'ProductGallery', 'DynamicPlaces', 'Maps', 'SearchOrganizationList'],
            'network_bidding_strategy_type' => 'NETWORK_DEFAULT',
            'network_placement_types' => ['Network', 'Maps'],
            'campaign_settings' => [
                'ADD_METRICA_TAG' => 'YES',
                'ADD_TO_FAVORITES' => 'YES',
                'ENABLE_AREA_OF_INTEREST_TARGETING' => 'YES'
            ],
            'counter_ids' => [1, 2], // ID ваших счетчиков Яндекс.Метрики
            'priority_goals' => [
                [
                    'GoalId' => 1,
                    'Value' => 100,
                    'IsMetrikaSourceOfValue' => true
                ]
            ],
            'tracking_params' => 'utm_source=yandex&utm_medium=cpc',
            'attribution_model' => 'LC',
            'consider_working_weekends' => 'NO',
            'holidays_schedule' => [
                'SuspendOnHolidays' => 'YES',
                'BidPercent' => 100,
                'StartHour' => 0,
                'EndHour' => 24
            ]
        ];
    }
} 