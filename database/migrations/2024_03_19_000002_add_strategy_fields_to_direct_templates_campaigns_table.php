<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            $table->string('strategy_type')->nullable()->after('platforms');
            $table->decimal('weekly_budget', 10, 2)->nullable()->after('strategy_type');
            $table->decimal('daily_budget', 10, 2)->nullable()->after('weekly_budget');
            $table->string('max_clicks_payment_type')->nullable()->after('daily_budget');
            $table->string('max_clicks_limit_type')->nullable()->after('max_clicks_payment_type');
            $table->decimal('max_clicks_average_cpc', 10, 2)->nullable()->after('max_clicks_limit_type');
            $table->string('max_conversions_payment_type')->nullable()->after('max_clicks_average_cpc');
            $table->string('max_conversions_clicks_limit_type')->nullable()->after('max_conversions_payment_type');
            $table->decimal('max_conversions_clicks_crr', 5, 2)->nullable()->after('max_conversions_clicks_limit_type');
            $table->string('max_conversions_conversions_limit_type')->nullable()->after('max_conversions_clicks_crr');
            $table->decimal('max_conversions_conversions_crr', 5, 2)->nullable()->after('max_conversions_conversions_limit_type');
            $table->decimal('max_conversions_weekly_budget', 10, 2)->nullable()->after('max_conversions_conversions_crr');
        });
    }

    public function down(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            $table->dropColumn([
                'strategy_type',
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
            ]);
        });
    }
}; 