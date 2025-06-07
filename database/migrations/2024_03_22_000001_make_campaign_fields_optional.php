<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            // Делаем все обязательные поля необязательными
            $table->string('name')->nullable()->change();
            $table->date('start_date')->nullable()->change();
            $table->decimal('daily_budget_amount', 10, 2)->nullable()->change();
            
            // Добавляем поле для отслеживания заполненности разделов
            $table->json('completed_sections')->nullable()->after('negative_keyword_shared_set_ids');
        });
    }

    public function down(): void
    {
        Schema::table('direct_templates_campaigns', function (Blueprint $table) {
            // Возвращаем обязательные поля
            $table->string('name')->nullable(false)->change();
            $table->date('start_date')->nullable(false)->change();
            $table->decimal('daily_budget_amount', 10, 2)->nullable(false)->change();
            
            // Удаляем поле отслеживания заполненности
            $table->dropColumn('completed_sections');
        });
    }
}; 