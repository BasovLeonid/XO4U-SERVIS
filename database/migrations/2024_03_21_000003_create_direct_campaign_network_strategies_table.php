<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_campaign_network_strategies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direct_campaign_id')->constrained()->onDelete('cascade');
            $table->string('yandex_campaign_id')->nullable()->comment('Идентификатор кампании');

            // Стратегии показа в сетях
            $table->enum('network_strategy_type', [
                'WB_MAXIMUM_CLICKS',        // Максимум кликов  
                'AVERAGE_CPC',              // Максимум кликов  по средней цене   
                'WB_MAXIMUM_CONVERSION_RATE', // Максимум конверсий
                'AVERAGE_CPA',              //   Максимум конверсий по средней цене
                'PAY_FOR_CONVERSION',       // Оплата за конверсию
            ])->nullable()->comment('Стратегия показа в сетях');

            // Поля для стратегии WbMaximumClicks (Максимум кликов)
            $table->decimal('network_wb_maximum_clicks_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('network_wb_maximum_clicks_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');

            // Поля для стратегии AverageCpc (Максимум кликов по средней цене)
            $table->decimal('network_average_cpc_average_cpc', 15, 6)
                ->nullable()
                ->comment('Средняя цена клика в валюте рекламодателя, умноженная на 1 000 000');
            $table->decimal('network_average_cpc_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

            // Поля для стратегии WbMaximumConversionRate (Максимум конверсий)
            $table->decimal('network_wb_maximum_conversion_rate_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('network_wb_maximum_conversion_rate_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');
            $table->unsignedBigInteger('network_wb_maximum_conversion_rate_goal_id')
                ->nullable()
                ->comment('Идентификатор цели Яндекс Метрики');

            // Поля для стратегии AverageCpa (Максимум конверсий по средней цене)
            $table->decimal('network_average_cpa_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('network_average_cpa_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');
            $table->json('network_average_cpa_exploration_budget')
                ->nullable()
                ->comment('{
                    "MinimumExplorationBudget": 0,
                    "IsMinimumExplorationBudgetCustom": "YES"
                }');
            $table->unsignedBigInteger('network_average_cpa_goal_id')
                ->nullable()
                ->comment('Идентификатор цели Яндекс Метрики');
            $table->decimal('network_average_cpa_average_cpa', 15, 6)
                ->nullable()
                ->comment('Средняя цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');

            // Поля для стратегии AverageCpaMultipleGoals
            $table->decimal('network_average_cpa_multiple_goals_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('network_average_cpa_multiple_goals_bid_ceiling', 15, 6)
                ->nullable()
                ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');
            $table->json('network_average_cpa_multiple_goals_exploration_budget')
                ->nullable()
                ->comment('{
                    "MinimumExplorationBudget": 0,
                    "IsMinimumExplorationBudgetCustom": "YES"
                }');
            $table->json('network_average_cpa_multiple_goals_priority_goals')
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
            $table->decimal('network_pay_for_conversion_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->decimal('network_pay_for_conversion_cpa', 15, 6)
                ->nullable()
                ->comment('Цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');
            $table->unsignedBigInteger('network_pay_for_conversion_goal_id')
                ->nullable()
                ->comment('Идентификатор цели Яндекс Метрики');

            // Поля для стратегии PayForConversionMultipleGoals
            $table->decimal('network_pay_for_conversion_multiple_goals_weekly_spend_limit', 15, 6)
                ->nullable()
                ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');
            $table->json('network_pay_for_conversion_multiple_goals_priority_goals')
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
            $table->index('network_strategy_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_campaign_network_strategies');
    }
}; 