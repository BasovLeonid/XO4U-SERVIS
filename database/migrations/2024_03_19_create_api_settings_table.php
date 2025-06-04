<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('api_settings', function (Blueprint $table) {
            $table->id();
            $table->string('service'); // yandex_direct, yandex_metrika, yandex_yookassa
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('redirect_uri');
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->timestamps();
            
            // Уникальный индекс для сервиса
            $table->unique('service');
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_settings');
    }
}; 