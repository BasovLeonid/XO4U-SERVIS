<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_campaign_negative_keywords', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direct_campaign_id')->constrained()->onDelete('cascade');
            $table->string('yandex_campaign_id')->nullable()->comment('Идентификатор кампании');
            $table->string('yandex_ad_group_id')->nullable()->comment('Идентификатор группы объявлений');

            // Минус-фразы
            $table->json('negative_keywords')
                ->nullable()
                ->comment('{
                    "Items": []  // Массив минус-фраз, общих для всех ключевых фраз кампании
                }');

            $table->json('setting_param')->nullable();

            // Технические поля
            $table->timestamps();
            $table->softDeletes();

            // Индексы
            $table->index('direct_campaign_id');
            $table->index('yandex_campaign_id');
            $table->index('yandex_ad_group_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_campaign_negative_keywords');
    }
}; 