<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название шаблона');
            $table->text('description')->nullable()->comment('Описание шаблона');
            $table->json('types')->comment('Типы шаблона (search, network, maps)');
            $table->string('strategy')->comment('Стратегия шаблона');
            $table->string('image')->nullable()->comment('Изображение шаблона');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_templates');
    }
}; 