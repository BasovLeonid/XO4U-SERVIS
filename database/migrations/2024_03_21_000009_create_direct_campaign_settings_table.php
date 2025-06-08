<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_campaign_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direct_campaign_id')->constrained()->onDelete('cascade');
            $table->string('yandex_campaign_id')->nullable()->comment('Идентификатор кампании');

            // Параметры URL для шаблонов
            $table->string('tracking_params')
                ->nullable()
                ->comment('Параметры URL для шаблонов');

            // Модель атрибуции
            $table->enum('attribution_model', [
                'FC',      // первый переход
                'LC',      // последний переход
                'LSC',     // последний значимый переход
                'LYDC',    // последний переход из Яндекс Директа
                'FCCD',    // первый переход кросс-девайс
                'LSCCD',   // последний значимый переход кросс-девайс
                'LYDCCD',  // последний переход из Яндекс Директа кросс-девайс
                'AUTO'     // автоматическая атрибуция
            ])
                ->default('AUTO')
                ->comment('Модель атрибуции, используемая для оптимизации конверсий');

            // Настройки меток и отслеживания
            $table->boolean('add_metrica_tag')
                ->default(true)
                ->comment('Автоматически добавлять в ссылку объявления метку yclid с уникальным номером клика');

            $table->boolean('add_openstat_tag')
                ->default(false)
                ->comment('При переходе на сайт рекламодателя добавлять к URL метку в формате OpenStat');

            // Настройки управления кампанией
            $table->boolean('add_to_favorites')
                ->default(false)
                ->comment('Добавить кампанию в самые важные для применения фильтра в веб-интерфейсе');

            $table->boolean('campaign_exact_phrase_matching_enabled')
                ->default(false)
                ->comment('Включает отбор фразы по точности соответствия внутри кампании');

            // Настройки таргетинга и гео
            $table->boolean('enable_area_of_interest_targeting')
                ->default(true)
                ->comment('Включить Расширенный географический таргетинг');

            // Настройки отображения
            $table->boolean('enable_company_info')
                ->default(true)
                ->comment('При показе на Яндекс Картах добавлять в объявление информацию об организации из Яндекс Справочника');

            $table->boolean('enable_extended_ad_title')
                ->default(true)
                ->comment('Включить подстановку части текста объявления в заголовок');

            // Настройки мониторинга и оптимизации
            $table->boolean('enable_site_monitoring')
                ->default(false)
                ->comment('Останавливать показы при недоступности сайта рекламодателя');

            $table->boolean('exclude_paused_competing_ads')
                ->default(false)
                ->comment('Рассчитывать прогнозируемые ставки без учета ставок в объявлениях конкурентов, остановленных в соответствии с временным таргетингом');

            $table->boolean('maintain_network_cpc')
                ->default(true)
                ->comment('Удерживать среднюю цену клика в сетях ниже средней цены на поиске');

            // Настройки обслуживания
            $table->boolean('require_servicing')
                ->default(false)
                ->comment('Перевести кампанию на обслуживание персональным менеджером');

            $table->boolean('shared_account_enabled')
                ->default(false)
                ->comment('Подключен общий счет');

            // Настройки оптимизации
            $table->boolean('alternative_texts_enabled')
                ->default(false)
                ->comment('Оптимизировать текст объявлений под запрос');

            $table->json('setting_param')->nullable();

            // Технические поля
            $table->timestamps();
            $table->softDeletes();

            // Индексы
            $table->index('direct_campaign_id');
            $table->index('yandex_campaign_id');
            $table->index('attribution_model');
        });
    }

    public function down()
    {
        Schema::dropIfExists('direct_campaign_settings');
    }
}; 