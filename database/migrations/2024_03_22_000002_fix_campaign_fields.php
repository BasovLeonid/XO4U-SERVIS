<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            // Удаляем дублирующиеся поля только если они существуют
            $columns = [
                'weekly_budget',
                'daily_budget',
                'max_clicks_payment_type',
                'max_clicks_limit_type',
                'max_clicks_average_cpc',
                'max_conversions_payment_type',
                'max_conversions_clicks_limit_type',
                'max_conversions_clicks_crr',
                'max_conversions_conversions_limit_type',
                'max_conversions_conversions_crr',
                'max_conversions_weekly_budget'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('direct_templates_campaigns', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Добавляем недостающие поля
            if (!Schema::hasColumn('direct_templates_campaigns', 'completed_sections')) {
                $table->json('completed_sections')->nullable()->after('campaign_settings_option');
            }
            
            // Изменяем типы полей для соответствия API
            $table->enum('search_bidding_strategy_type', [
                'AVERAGE_CPC',
                'AVERAGE_CPA',
                'PAY_FOR_CONVERSION',
                'WB_MAXIMUM_CONVERSION_RATE',
                'HIGHEST_POSITION',
                'SERVING_OFF',
                'WB_MAXIMUM_CLICKS',
                'AVERAGE_CRR',
                'PAY_FOR_CONVERSION_CRR'
            ])->nullable()->change();

            $table->enum('network_bidding_strategy_type', [
                'AVERAGE_CPC',
                'AVERAGE_CPA',
                'PAY_FOR_CONVERSION',
                'WB_MAXIMUM_CONVERSION_RATE',
                'NETWORK_DEFAULT',
                'SERVING_OFF',
                'WB_MAXIMUM_CLICKS',
                'AVERAGE_CRR',
                'PAY_FOR_CONVERSION_CRR'
            ])->nullable()->change();

            // Делаем поля необязательными
            $table->string('name')->nullable()->change();
            $table->string('status')->default('draft')->change();
            $table->date('start_date')->nullable()->change();
            $table->decimal('daily_budget_amount', 10, 2)->nullable()->change();
            $table->enum('daily_budget_mode', ['STANDARD', 'DISTRIBUTED'])->nullable()->change();
            $table->enum('consider_working_weekends', ['YES', 'NO'])->nullable()->change();
            $table->string('campaign_type')->default('UnifiedCampaign')->change();
            $table->enum('campaign_settings_option', [
                'ADD_METRICA_TAG',
                'ADD_TO_FAVORITES',
                'ENABLE_AREA_OF_INTEREST_TARGETING',
                'ENABLE_SITE_MONITORING',
                'REQUIRE_SERVICING',
                'ENABLE_COMPANY_INFO',
                'CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED',
                'ALTERNATIVE_TEXTS_ENABLED'
            ])->nullable()->change();
            $table->enum('attribution_model', [
                'LC',
                'LSC',
                'FC',
                'LYDC',
                'LSCCD',
                'FCCD',
                'LYDCCD',
                'AUTO'
            ])->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            // Восстанавливаем удаленные поля
            $columns = [
                'weekly_budget' => 'decimal',
                'daily_budget' => 'decimal',
                'max_clicks_payment_type' => 'string',
                'max_clicks_limit_type' => 'string',
                'max_clicks_average_cpc' => 'decimal',
                'max_conversions_payment_type' => 'string',
                'max_conversions_clicks_limit_type' => 'string',
                'max_conversions_clicks_crr' => 'decimal',
                'max_conversions_conversions_limit_type' => 'string',
                'max_conversions_conversions_crr' => 'decimal',
                'max_conversions_weekly_budget' => 'decimal'
            ];

            foreach ($columns as $column => $type) {
                if (!Schema::hasColumn('direct_templates_campaigns', $column)) {
                    if ($type === 'decimal') {
                        $table->decimal($column, 10, 2)->nullable();
                    } else {
                        $table->string($column)->nullable();
                    }
                }
            }

            // Удаляем добавленные поля
            if (Schema::hasColumn('direct_templates_campaigns', 'completed_sections')) {
                $table->dropColumn('completed_sections');
            }

            // Восстанавливаем обязательные поля
            $table->string('name')->nullable(false)->change();
            $table->string('status')->default('active')->change();
            $table->date('start_date')->nullable(false)->change();
            $table->decimal('daily_budget_amount', 10, 2)->nullable(false)->change();
            $table->enum('daily_budget_mode', ['STANDARD', 'DISTRIBUTED'])->nullable(false)->change();
            $table->enum('consider_working_weekends', ['YES', 'NO'])->nullable(false)->change();
            $table->string('campaign_type')->default('UnifiedCampaign')->change();
            $table->enum('campaign_settings_option', [
                'ADD_METRICA_TAG',
                'ADD_TO_FAVORITES',
                'ENABLE_AREA_OF_INTEREST_TARGETING',
                'ENABLE_SITE_MONITORING',
                'REQUIRE_SERVICING',
                'ENABLE_COMPANY_INFO',
                'CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED',
                'ALTERNATIVE_TEXTS_ENABLED'
            ])->nullable(false)->change();
            $table->enum('attribution_model', [
                'LC',
                'LSC',
                'FC',
                'LYDC',
                'LSCCD',
                'FCCD',
                'LYDCCD',
                'AUTO'
            ])->nullable(false)->change();
        });
    }
}; 