<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DirectTemplatesCampaign;
use App\Models\DirectTemplate;

class DirectTemplatesCampaignSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем первый шаблон
        $template = DirectTemplate::first();

        if (!$template) {
            return;
        }

        // Кампания только для РСЯ
        DirectTemplatesCampaign::create([
            'template_id' => $template->id,
            'name' => 'Тестовая кампания РСЯ',
            'status' => 'active',
            'start_date' => now(),
            'daily_budget_amount' => 1000.00,
            'daily_budget_mode' => 'STANDARD',
            'search_placement_types' => [
                'Network' => 'YES',
                'ProductGallery' => 'NO',
                'SearchResult' => 'NO',
                'DynamicPlaces' => 'NO',
                'SearchOrganizationList' => 'NO',
                'Maps' => 'NO'
            ],
            'search_bidding_strategy_type' => 'WB_MAXIMUM_CLICKS',
            'search_bidding_strategy' => [
                'WeeklySpendLimit' => 1000.00,
                'AverageCpc' => 50.00
            ]
        ]);

        // Кампания только для поиска
        DirectTemplatesCampaign::create([
            'template_id' => $template->id,
            'name' => 'Тестовая кампания Поиск',
            'status' => 'active',
            'start_date' => now(),
            'daily_budget_amount' => 500.00,
            'daily_budget_mode' => 'STANDARD',
            'search_placement_types' => [
                'Network' => 'NO',
                'ProductGallery' => 'NO',
                'SearchResult' => 'YES',
                'DynamicPlaces' => 'NO',
                'SearchOrganizationList' => 'NO',
                'Maps' => 'NO'
            ],
            'search_bidding_strategy_type' => 'AVERAGE_CPC',
            'search_bidding_strategy' => [
                'AverageCpc' => 30.00
            ]
        ]);
    }
} 