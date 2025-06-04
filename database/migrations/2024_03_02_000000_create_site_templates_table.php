<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('template_code')->unique();
            $table->text('description')->nullable();
            $table->string('preview_image')->nullable();
            $table->enum('status', ['active', 'draft', 'archived'])->default('draft');
            $table->timestamps();
        });

        Schema::create('site_template_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_template_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('block_code');
            $table->json('content')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_required')->default(false);
            $table->timestamps();

            $table->unique(['site_template_id', 'block_code']);
        });

        Schema::create('site_template_variables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_template_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('variable_code');
            $table->string('type');
            $table->text('default_value')->nullable();
            $table->json('validation_rules')->nullable();
            $table->boolean('is_required')->default(false);
            $table->timestamps();

            $table->unique(['site_template_id', 'variable_code']);
        });

        Schema::create('site_instances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_template_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('domain')->nullable();
            $table->enum('status', ['active', 'draft', 'archived'])->default('draft');
            $table->json('variables')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_instances');
        Schema::dropIfExists('site_template_variables');
        Schema::dropIfExists('site_template_blocks');
        Schema::dropIfExists('site_templates');
    }
}; 