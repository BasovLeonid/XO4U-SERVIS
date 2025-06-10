<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('direct_campaign_search_strategies', function (Blueprint $table) {
            $table->string('yandex_campaign_id')->nullable()->change();
            $table->enum('search_strategy_type', [
                'HIGHEST_POSITION',
                'WB_MAXIMUM_CLICKS',
                'AVERAGE_CPC',
                'WB_MAXIMUM_CONVERSION_RATE',
                'AVERAGE_CPA',
                'PAY_FOR_CONVERSION'
            ])->nullable()->change();
            $table->decimal('search_wb_maximum_clicks_weekly_spend_limit', 15, 6)->nullable()->change();
            $table->decimal('search_wb_maximum_clicks_bid_ceiling', 15, 6)->nullable()->change();
            $table->decimal('search_average_cpc_average_cpc', 15, 6)->nullable()->change();
            $table->decimal('search_average_cpc_weekly_spend_limit', 15, 6)->nullable()->change();
            $table->decimal('search_wb_maximum_conversion_rate_weekly_spend_limit', 15, 6)->nullable()->change();
            $table->decimal('search_wb_maximum_conversion_rate_bid_ceiling', 15, 6)->nullable()->change();
            $table->unsignedBigInteger('search_wb_maximum_conversion_rate_goal_id')->nullable()->change();
            $table->decimal('search_average_cpa_weekly_spend_limit', 15, 6)->nullable()->change();
            $table->decimal('search_average_cpa_bid_ceiling', 15, 6)->nullable()->change();
            $table->json('search_average_cpa_exploration_budget')->nullable()->change();
            $table->unsignedBigInteger('search_average_cpa_goal_id')->nullable()->change();
            $table->decimal('search_average_cpa_average_cpa', 15, 6)->nullable()->change();
            $table->decimal('search_average_cpa_multiple_goals_weekly_spend_limit', 15, 6)->nullable()->change();
            $table->decimal('search_average_cpa_multiple_goals_bid_ceiling', 15, 6)->nullable()->change();
            $table->json('search_average_cpa_multiple_goals_exploration_budget')->nullable()->change();
            $table->json('search_average_cpa_multiple_goals_priority_goals')->nullable()->change();
            $table->decimal('search_pay_for_conversion_weekly_spend_limit', 15, 6)->nullable()->change();
            $table->decimal('search_pay_for_conversion_cpa', 15, 6)->nullable()->change();
            $table->unsignedBigInteger('search_pay_for_conversion_goal_id')->nullable()->change();
            $table->decimal('search_pay_for_conversion_multiple_goals_weekly_spend_limit', 15, 6)->nullable()->change();
            $table->json('search_pay_for_conversion_multiple_goals_priority_goals')->nullable()->change();
            $table->json('setting_param')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('direct_campaign_search_strategies', function (Blueprint $table) {
            $table->string('yandex_campaign_id')->nullable(false)->change();
            $table->enum('search_strategy_type', [
                'HIGHEST_POSITION',
                'WB_MAXIMUM_CLICKS',
                'AVERAGE_CPC',
                'WB_MAXIMUM_CONVERSION_RATE',
                'AVERAGE_CPA',
                'PAY_FOR_CONVERSION'
            ])->nullable(false)->change();
            $table->decimal('search_wb_maximum_clicks_weekly_spend_limit', 15, 6)->nullable(false)->change();
            $table->decimal('search_wb_maximum_clicks_bid_ceiling', 15, 6)->nullable(false)->change();
            $table->decimal('search_average_cpc_average_cpc', 15, 6)->nullable(false)->change();
            $table->decimal('search_average_cpc_weekly_spend_limit', 15, 6)->nullable(false)->change();
            $table->decimal('search_wb_maximum_conversion_rate_weekly_spend_limit', 15, 6)->nullable(false)->change();
            $table->decimal('search_wb_maximum_conversion_rate_bid_ceiling', 15, 6)->nullable(false)->change();
            $table->unsignedBigInteger('search_wb_maximum_conversion_rate_goal_id')->nullable(false)->change();
            $table->decimal('search_average_cpa_weekly_spend_limit', 15, 6)->nullable(false)->change();
            $table->decimal('search_average_cpa_bid_ceiling', 15, 6)->nullable(false)->change();
            $table->json('search_average_cpa_exploration_budget')->nullable(false)->change();
            $table->unsignedBigInteger('search_average_cpa_goal_id')->nullable(false)->change();
            $table->decimal('search_average_cpa_average_cpa', 15, 6)->nullable(false)->change();
            $table->decimal('search_average_cpa_multiple_goals_weekly_spend_limit', 15, 6)->nullable(false)->change();
            $table->decimal('search_average_cpa_multiple_goals_bid_ceiling', 15, 6)->nullable(false)->change();
            $table->json('search_average_cpa_multiple_goals_exploration_budget')->nullable(false)->change();
            $table->json('search_average_cpa_multiple_goals_priority_goals')->nullable(false)->change();
            $table->decimal('search_pay_for_conversion_weekly_spend_limit', 15, 6)->nullable(false)->change();
            $table->decimal('search_pay_for_conversion_cpa', 15, 6)->nullable(false)->change();
            $table->unsignedBigInteger('search_pay_for_conversion_goal_id')->nullable(false)->change();
            $table->decimal('search_pay_for_conversion_multiple_goals_weekly_spend_limit', 15, 6)->nullable(false)->change();
            $table->json('search_pay_for_conversion_multiple_goals_priority_goals')->nullable(false)->change();
            $table->json('setting_param')->nullable(false)->change();
        });
    }
}; 