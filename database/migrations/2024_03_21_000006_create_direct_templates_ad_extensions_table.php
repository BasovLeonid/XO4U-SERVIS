<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direct_templates_ad_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_template_id')->constrained('direct_templates_campaigns')->onDelete('cascade');
            $table->string('type');
            $table->json('settings');
            $table->json('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direct_templates_ad_extensions');
    }
}; 