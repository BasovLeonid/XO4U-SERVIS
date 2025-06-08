<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_campaign_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direct_campaign_id')->constrained()->onDelete('cascade');
            $table->string('yandex_campaign_id')->nullable()->comment('Идентификатор кампании');

            // Поле для хранения идентификаторов счетчиков Яндекс Метрики
            $table->json('counter_ids')
                ->nullable()
                ->comment('{
                    "Items": [0]  // Массив идентификаторов счетчиков Яндекс Метрики
                }');

            // Для удобства поиска и фильтрации можно добавить отдельное поле для основного счетчика
            $table->unsignedBigInteger('primary_counter_id')
                ->nullable()
                ->comment('Идентификатор основного счетчика Яндекс Метрики');

            // Поля для приоритетных целей
            $table->json('priority_goals')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "GoalId": 0,      // Идентификатор цели Яндекс Метрики
                            "Value": 0,       // Ценность конверсии в валюте рекламодателя, умноженная на 1 000 000
                            "IsMetrikaSourceOfValue": "YES"  // Флаг использования значения из Метрики
                        }
                    ]
                }');

            // Для удобства поиска и фильтрации можно добавить отдельные поля
            $table->unsignedBigInteger('primary_goal_id')
                ->nullable()
                ->comment('Идентификатор основной цели Яндекс Метрики');

            $table->decimal('primary_goal_value', 15, 6)
                ->nullable()
                ->comment('Ценность основной цели в валюте рекламодателя, умноженная на 1 000 000');

            $table->json('setting_param')->nullable();

            // Технические поля
            $table->timestamps();
            $table->softDeletes();

            // Индексы для быстрого поиска
            $table->index('direct_campaign_id');
            $table->index('yandex_campaign_id');
            $table->index('primary_counter_id');
            $table->index('primary_goal_id');
            $table->index('primary_goal_value');
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_campaign_metrics');
    }
}; 