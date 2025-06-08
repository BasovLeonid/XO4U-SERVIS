<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('direct_campaign_bid_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('direct_campaign_id')->constrained()->onDelete('cascade');
            $table->string('yandex_campaign_id')->nullable()->comment('Идентификатор кампании');
            $table->string('yandex_ad_group_id')->nullable()->comment('Идентификатор группы объявлений');

            // Корректировки для мобильных устройств
            $table->json('mobile_adjustment')
                ->nullable()
                ->comment('{
                    "BidModifier": 100,          // Значение коэффициента к ставке (0-1300)
                    "OperatingSystemType": null  // Тип операционной системы
                }');

            // Корректировки для планшетов
            $table->json('tablet_adjustment')
                ->nullable()
                ->comment('{
                    "BidModifier": 100,          // Значение коэффициента к ставке (0-1300)
                    "OperatingSystemType": null  // Тип операционной системы
                }');

            // Корректировки для компьютеров и Smart TV
            $table->json('desktop_adjustment')
                ->nullable()
                ->comment('{
                    "BidModifier": 100  // Значение коэффициента к ставке (0-1300)
                }');

            // Корректировки только для компьютеров
            $table->json('desktop_only_adjustment')
                ->nullable()
                ->comment('{
                    "BidModifier": 100  // Значение коэффициента к ставке (0-1300)
                }');

            // Корректировки по полу и возрасту
            $table->json('demographics_adjustments')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "Gender": null,       // Пол пользователя (GENDER_MALE/GENDER_FEMALE)
                            "Age": null,          // Возрастная группа
                            "BidModifier": 100    // Значение коэффициента к ставке (0-1300)
                        }
                    ]
                }');

            // Корректировки для целевой аудитории
            $table->json('retargeting_adjustments')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "RetargetingConditionId": 0,  // Идентификатор условия ретаргетинга
                            "BidModifier": 100            // Значение коэффициента к ставке (0-1300)
                        }
                    ]
                }');

            // Корректировки по региону показа
            $table->json('regional_adjustments')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "RegionId": 0,        // Идентификатор региона
                            "BidModifier": 100    // Значение коэффициента к ставке (10-1300)
                        }
                    ]
                }');

            // Корректировка для видеодополнений
            $table->json('video_adjustment')
                ->nullable()
                ->comment('{
                    "BidModifier": 100  // Значение коэффициента к ставке (50-1300)
                }');

            // Корректировка для смарт-объявлений
            $table->json('smart_ad_adjustment')
                ->nullable()
                ->comment('{
                    "BidModifier": 100  // Значение коэффициента к ставке (20-1300)
                }');

            // Корректировки на эксклюзивное размещение
            $table->json('serp_layout_adjustments')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "SerpLayout": null,   // Блок показа (ALONE/SUGGEST)
                            "BidModifier": 100    // Значение коэффициента к ставке (1-1300)
                        }
                    ]
                }');

            // Корректировки на платежеспособность
            $table->json('income_grade_adjustments')
                ->nullable()
                ->comment('{
                    "Items": [
                        {
                            "Grade": null,        // Уровень платежеспособности
                            "BidModifier": 100    // Значение коэффициента к ставке (1-1300)
                        }
                    ]
                }');

            // Корректировки на группу
            $table->json('ad_group_adjustment')
                ->nullable()
                ->comment('{
                    "BidModifier": 100  // Значение коэффициента к ставке (1-1300)
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
        Schema::dropIfExists('direct_campaign_bid_adjustments');
    }
}; 