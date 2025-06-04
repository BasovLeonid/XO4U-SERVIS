<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direct_templates_feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_template_id')->constrained('direct_templates_campaigns')->onDelete('cascade');
            $table->string('name');
            $table->string('business_type');
            $table->string('source_type');
            $table->json('url_feed')->nullable();
            $table->json('file_feed')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direct_templates_feeds');
    }
}; 