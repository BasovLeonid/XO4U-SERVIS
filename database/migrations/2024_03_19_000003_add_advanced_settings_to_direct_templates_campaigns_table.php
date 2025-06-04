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
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            $table->json('platforms')->nullable()->after('campaign_type');
            $table->decimal('weekly_budget', 10, 2)->nullable()->after('daily_budget_mode');
            $table->decimal('max_clicks_average_cpc', 10, 2)->nullable()->after('weekly_budget');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            $table->dropColumn(['platforms', 'weekly_budget', 'max_clicks_average_cpc']);
        });
    }
}; 