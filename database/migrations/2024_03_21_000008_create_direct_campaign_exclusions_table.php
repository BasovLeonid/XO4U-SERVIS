<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_campaign_exclusions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direct_campaign_id')->constrained()->onDelete('cascade');
            $table->string('yandex_campaign_id')->nullable()->comment('Идентификатор кампании');

            // Заблокированные IP-адреса
            $table->json('blocked_ips')
                ->nullable()
                ->comment('{
                    "Items": []  // Массив IP-адресов, которым не нужно показывать объявления
                }');

            // Исключенные места показа
            $table->json('excluded_sites')
                ->nullable()
                ->comment('{
                    "Items": []  // Массив мест показа, где не нужно показывать объявления
                }');

            $table->json('setting_param')->nullable();

            // Технические поля
            $table->timestamps();
            $table->softDeletes();

            // Индексы
            $table->index('direct_campaign_id');
            $table->index('yandex_campaign_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_campaign_exclusions');
    }
}; 