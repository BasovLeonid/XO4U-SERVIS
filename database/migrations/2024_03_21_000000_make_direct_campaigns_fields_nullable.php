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
        Schema::table('direct_campaigns', function (Blueprint $table) {
            $table->string('type')->nullable()->change();
            $table->string('url')->nullable()->change();
            $table->json('summary')->nullable()->change();
            $table->json('user_param')->nullable()->change();
            $table->json('template_param')->nullable()->change();
            $table->json('setting_param')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('status')->default('draft')->nullable()->change();
            $table->decimal('daily_budget_amount', 15, 6)->nullable()->change();
            $table->enum('daily_budget_mode', ['STANDARD', 'DISTRIBUTED'])->default('STANDARD')->nullable()->change();
            $table->enum('search_result', ['YES', 'NO'])->default('YES')->nullable()->change();
            $table->enum('dynamic_places', ['YES', 'NO'])->default('NO')->nullable()->change();
            $table->enum('product_gallery', ['YES', 'NO'])->default('YES')->nullable()->change();
            $table->enum('search_organization_list', ['YES', 'NO'])->default('NO')->nullable()->change();
            $table->enum('network', ['YES', 'NO'])->default('YES')->nullable()->change();
            $table->enum('maps', ['YES', 'NO'])->default('NO')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('direct_campaigns', function (Blueprint $table) {
            $table->string('type')->nullable(false)->change();
            $table->string('url')->nullable(false)->change();
            $table->json('summary')->nullable(false)->change();
            $table->json('user_param')->nullable(false)->change();
            $table->json('template_param')->nullable(false)->change();
            $table->json('setting_param')->nullable(false)->change();
            $table->string('name')->nullable(false)->change();
            $table->string('status')->default('draft')->nullable(false)->change();
            $table->decimal('daily_budget_amount', 15, 6)->nullable(false)->change();
            $table->enum('daily_budget_mode', ['STANDARD', 'DISTRIBUTED'])->default('STANDARD')->nullable(false)->change();
            $table->enum('search_result', ['YES', 'NO'])->default('YES')->nullable(false)->change();
            $table->enum('dynamic_places', ['YES', 'NO'])->default('NO')->nullable(false)->change();
            $table->enum('product_gallery', ['YES', 'NO'])->default('YES')->nullable(false)->change();
            $table->enum('search_organization_list', ['YES', 'NO'])->default('NO')->nullable(false)->change();
            $table->enum('network', ['YES', 'NO'])->default('YES')->nullable(false)->change();
            $table->enum('maps', ['YES', 'NO'])->default('NO')->nullable(false)->change();
        });
    }
}; 