<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_templates_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('direct_templates')->onDelete('cascade');
            
            // Основные настройки
            $table->string('name'); // required
            $table->string('status')->default('active'); // Добавляем поле status
            $table->string('url')->nullable(); // Добавляем поле url
            $table->string('client_info')->nullable();
            $table->string('time_zone')->nullable();
            $table->date('start_date'); // required
            $table->date('end_date')->nullable();
            
            // Ежедневный бюджет
            $table->decimal('daily_budget_amount', 10, 2); // required
            $table->enum('daily_budget_mode', ['STANDARD', 'DISTRIBUTED'])->default('STANDARD'); // required
            
            // Настройки уведомлений
            $table->json('sms_settings')->nullable(); // Events: array of strings, TimeFrom: string, TimeTo: string
            $table->json('email_settings')->nullable(); // Email: string, CheckPositionInterval: int, WarningBalance: int, SendAccountNews: YES/NO, SendWarnings: YES/NO
            
            // Списки
            $table->json('negative_keywords')->nullable(); // Items: array of strings
            $table->json('blocked_ips')->nullable(); // Items: array of strings
            $table->json('excluded_sites')->nullable(); // Items: array of strings
            
            // Настройки таргетинга по времени
            $table->json('time_targeting_schedule')->nullable(); // Items: array of strings
            $table->enum('consider_working_weekends', ['YES', 'NO'])->default('NO'); // required
            $table->json('holidays_schedule')->nullable(); // SuspendOnHolidays: YES/NO, BidPercent: int, StartHour: int, EndHour: int
            
            // Тип кампании
            $table->string('campaign_type')->default('UnifiedCampaign');
            
            // Настройки стратегии для поиска (Search)
            $table->json('search_bidding_strategy')->nullable(); // Все типы стратегий (WbMaximumClicks, WbMaximumConversionRate, etc.)
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
            ])->nullable();
            $table->json('search_placement_types')->nullable(); // SearchResults, ProductGallery, DynamicPlaces, Maps, SearchOrganizationList
            
            // Настройки стратегии для сети (Network)
            $table->json('network_bidding_strategy')->nullable(); // Все типы стратегий
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
            ])->nullable();
            $table->json('network_placement_types')->nullable(); // Network, Maps
            
            // Дополнительные настройки кампании
            $table->json('campaign_settings')->nullable(); // Массив настроек с Option и Value
            $table->enum('campaign_settings_option', [
                'ADD_METRICA_TAG',
                'ADD_TO_FAVORITES',
                'ENABLE_AREA_OF_INTEREST_TARGETING',
                'ENABLE_SITE_MONITORING',
                'REQUIRE_SERVICING',
                'ENABLE_COMPANY_INFO',
                'CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED',
                'ALTERNATIVE_TEXTS_ENABLED'
            ])->nullable();
            
            // Счетчики и цели
            $table->json('counter_ids')->nullable(); // Items: array of integers
            $table->json('priority_goals')->nullable(); // Items: array of objects with GoalId, Value, IsMetrikaSourceOfValue
            
            // Параметры отслеживания
            $table->string('tracking_params')->nullable();
            $table->enum('attribution_model', [
                'LC',
                'LSC',
                'FC',
                'LYDC',
                'LSCCD',
                'FCCD',
                'LYDCCD',
                'AUTO'
            ])->nullable();
            
            // Настройки пакетной стратегии
            $table->json('package_bidding_strategy')->nullable(); // StrategyId, StrategyFromCampaignId, Platforms
            $table->json('package_bidding_platforms')->nullable(); // SearchResult, ProductGallery, Maps, SearchOrganizationList, Network, DynamicPlaces
            
            // ID общих наборов минус-слов
            $table->json('negative_keyword_shared_set_ids')->nullable(); // Items: array of longs
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_templates_campaigns');
    }
}; 