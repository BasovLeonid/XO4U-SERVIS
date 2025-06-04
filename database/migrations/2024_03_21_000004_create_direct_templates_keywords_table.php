<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direct_templates_keywords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_group_template_id')->constrained('direct_templates_ad_groups')->onDelete('cascade');
            $table->string('keyword');
            $table->string('type');
            $table->json('settings');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direct_templates_keywords');
    }
}; 