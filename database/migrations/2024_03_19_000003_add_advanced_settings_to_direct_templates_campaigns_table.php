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
            $table->decimal('max_clicks_average_cpc', 10, 2)->nullable()->after('platforms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            $table->dropColumn(['platforms', 'max_clicks_average_cpc']);
        });
    }
}; 