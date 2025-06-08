<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_campaign_search_strategies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direct_campaign_id')->constrained()->onDelete('cascade');
            $table->string('yandex_campaign_id')->nullable()->comment('Идентификатор кампании');

            // Стратегии показа на поиске
            $table->enum('search_strategy_type', [
                'HIGHEST_POSITION',         // Максимум кликов с ручными ставками
                'WB_MAXIMUM_CLICKS',        // Максимум кликов  
                'AVERAGE_CPC',              // Максимум кликов  по средней цене   
                'WB_MAXIMUM_CONVERSION_RATE', // Максимум конверсий
                'AVERAGE_CPA',              //   Максимум конверсий по средней цене
                'PAY_FOR_CONVERSION',       // Оплата за конверсию
            ])->nullable()->comment('Стратегия показа на поиске');

            // Поля для стратегии WbMaximumClicks (Максимум кликов)
            $table->decimal('search_wb_maximum_clicks_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('search_wb_maximum_clicks_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');

            // Поля для стратегии AverageCpc (Максимум кликов по средней цене)
            $table->decimal('search_average_cpc_average_cpc', 15, 6)
                ->nullable()
                ->comment('Средняя цена клика в валюте рекламодателя, умноженная на 1 000 000');
            $table->decimal('search_average_cpc_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

            // Поля для стратегии WbMaximumConversionRate (Максимум конверсий)
            $table->decimal('search_wb_maximum_conversion_rate_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('search_wb_maximum_conversion_rate_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');
            $table->unsignedBigInteger('search_wb_maximum_conversion_rate_goal_id')
                ->nullable()
                ->comment('Идентификатор цели Яндекс Метрики');

            // Поля для стратегии AverageCpa (Максимум конверсий по средней цене)
            $table->decimal('search_average_cpa_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('search_average_cpa_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');
            $table->json('search_average_cpa_exploration_budget')
                ->nullable()
                ->comment('{
                    "MinimumExplorationBudget": 0,
                    "IsMinimumExplorationBudgetCustom": "YES"
                }');
            $table->unsignedBigInteger('search_average_cpa_goal_id')
                ->nullable()
                ->comment('Идентификатор цели Яндекс Метрики');
            $table->decimal('search_average_cpa_average_cpa', 15, 6)
                ->nullable()
                ->comment('Средняя цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');

            // Поля для стратегии AverageCpaMultipleGoals
            $table->decimal('search_average_cpa_multiple_goals_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('search_average_cpa_multiple_goals_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');
            $table->json('search_average_cpa_multiple_goals_exploration_budget')
                ->nullable()
                ->comment('{
                    "MinimumExplorationBudget": 0,
                    "IsMinimumExplorationBudgetCustom": "YES"
                }');
            $table->json('search_average_cpa_multiple_goals_priority_goals')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "GoalId": 0,
                            "Value": 0,
                            "IsMetrikaSourceOfValue": "YES"
                        }
                    ]
                }');

            // Поля для стратегии PayForConversion (Оплата за конверсии)
            $table->decimal('search_pay_for_conversion_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('search_pay_for_conversion_cpa', 15, 6)
                ->nullable()
                ->comment('Цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');
            $table->unsignedBigInteger('search_pay_for_conversion_goal_id')
                ->nullable()
                ->comment('Идентификатор цели Яндекс Метрики');

            // Поля для стратегии PayForConversionMultipleGoals
            $table->decimal('search_pay_for_conversion_multiple_goals_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->json('search_pay_for_conversion_multiple_goals_priority_goals')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "GoalId": 0,
                            "Value": 0,
                            "IsMetrikaSourceOfValue": "YES"
                        }
                    ]
                }');

            $table->json('setting_param')->nullable();

            // Технические поля
            $table->timestamps();
            $table->softDeletes();

            // Индексы
            $table->index('direct_campaign_id');
            $table->index('yandex_campaign_id');
            $table->index('search_strategy_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_campaign_search_strategies');
    }
}; 