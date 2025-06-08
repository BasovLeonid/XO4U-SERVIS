Условия создания: 

- обязательные поля для сохранения Кампании только ID (внутреннй)
- обязательные поля для сохранения в базу данных отличаются от API

=========================

Основный данные компании:

Внутренние данные: 

$table->id();
$table->string('type'); // template / users
$table->foreignId('template_id')->nullable();
$table->foreignId('user_id')->nullable();
$table->foreignId('account_id')->nullable();
$table->string('url');
sumary json
user_param json
template_param json


Данные адаптированные с яндексом:
$table->string('name');
$table->ya_id("yandex_campaign_id");
$table->string('status')->default('draft');

// Поля для дневного бюджета
$table->decimal('daily_budget_amount', 15, 6)
    ->comment('Дневной бюджет кампании в валюте рекламодателя, умноженный на 1 000 000');

$table->enum('daily_budget_mode', ['STANDARD', 'DISTRIBUTED'])
    ->default('STANDARD')
    ->comment('Режим показа объявлений: STANDARD — стандартный, DISTRIBUTED — распределенный');


Места показа: 

Структура UnifiedCampaignPlatforms

$table->enum('search_result', ['YES', 'NO'])->default('YES')->comment('Поисковая выдача');
$table->enum('dynamic_places', ['YES', 'NO'])->default('NO')->comment('Динамические места на поиске');
$table->enum('product_gallery', ['YES', 'NO'])->default('YES')->comment('Товарная галерея');
$table->enum('search_organization_list', ['YES', 'NO'])->default('NO')->comment('Список организаций в результатах поиска');
$table->enum('network', ['YES', 'NO'])->default('YES')->comment('Рекламная сеть Яндекса');
$table->enum('maps', ['YES', 'NO'])->default('NO')->comment('Яндекс Карты');


setting_param json

[text](../../database/migrations)

==================


Стратегия показа на поиске: 

// Основные поля для идентификации

campaign_id (внутрений id)

$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');

// Стратегии показа на поиске

$table->enum('search_strategy_type', [
    'HIGHEST_POSITION',         // Максимум кликов с ручными ставками
    'WB_MAXIMUM_CLICKS',        // Максимум кликов  
    'AVERAGE_CPC',              // Максимум кликов  по средней цене   
    'WB_MAXIMUM_CONVERSION_RATE', // Максимум конверсий
    'AVERAGE_CPA',              //   Максимум конверсий по средней цене
    'PAY_FOR_CONVERSION',       // Оплата за конверсию
])->nullable()->comment('Стратегия показа на поиске');

Дополниетельные поля для стратегий на поиске: 

// Поля для стратегии WbMaximumClicks (Максимум кликов)
$table->decimal('search_wb_maximum_clicks_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('search_wb_maximum_clicks_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');



// Поля для стратегии AverageCpc (Максимум кликов  по средней цен)
$table->decimal('search_average_cpc_average_cpc', 15, 6)
    ->nullable()
    ->comment('Средняя цена клика в валюте рекламодателя, умноженная на 1 000 000');

$table->decimal('search_average_cpc_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');



// Поля для стратегии WbMaximumConversionRate (Максимум конверсий)

$table->decimal('search_wb_maximum_conversion_rate_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('search_wb_maximum_conversion_rate_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');

$table->unsignedBigInteger('search_wb_maximum_conversion_rate_goal_id')
    ->nullable()
    ->comment('Идентификатор цели Яндекс Метрики');



// Поля для стратегии AverageCpa (Максимум конверсий по средней цене)

$table->decimal('search_average_cpa_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('search_average_cpa_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');

$table->json('search_average_cpa_exploration_budget')
    ->nullable()
    ->comment('
    {
        "MinimumExplorationBudget": 0,
        "IsMinimumExplorationBudgetCustom": "YES"
    }');

$table->unsignedBigInteger('search_average_cpa_goal_id')
    ->nullable()
    ->comment('Идентификатор цели Яндекс Метрики');

$table->decimal('search_average_cpa_average_cpa', 15, 6)
    ->nullable()
    ->comment('Средняя цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');



// Поля для стратегии AverageCpaMultipleGoals (Максимум конверсий с оплатой за клики, удерживать среднюю цену конверсии по нескольким целям)

$table->decimal('search_average_cpa_multiple_goals_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('search_average_cpa_multiple_goals_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');


$table->json('search_average_cpa_multiple_goals_exploration_budget')
    ->nullable()
    ->comment('
    {
        "MinimumExplorationBudget": 0,
        "IsMinimumExplorationBudgetCustom": "YES"
    }');

// Приоритетные цели хранятся в JSON, так как это массив объектов
$table->json('search_average_cpa_multiple_goals_priority_goals')
    ->nullable()
    ->comment('
    {
        "Items": [
            {
                "GoalId": 0,
                "Value": 0,
                "IsMetrikaSourceOfValue": "YES"
            }
        ]
    }');



// Поля для стратегии PayForConversion (Оплата за конверсии)

$table->decimal('search_pay_for_conversion_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('search_pay_for_conversion_cpa', 15, 6)
    ->nullable()
    ->comment('Цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');

$table->unsignedBigInteger('search_pay_for_conversion_goal_id')
    ->nullable()
    ->comment('Идентификатор цели Яндекс Метрики');



// Поля для стратегии PayForConversionMultipleGoals (Максимум конверсий с оплатой за конверсии по каждой из указанных целей)

$table->decimal('search_pay_for_conversion_multiple_goals_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

// Приоритетные цели хранятся в JSON, так как это массив объектов
$table->json('search_pay_for_conversion_multiple_goals_priority_goals')
    ->nullable()
    ->comment('
    {
        "Items": [
            {
                "GoalId": 0,
                "Value": 0,
                "IsMetrikaSourceOfValue": "YES"
            }
        ]
    }');


setting_param json

============================================

Стратегии показа в сетях:

campaign_id (внутрений id)

$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');


// Стратегии показа в сетях

$table->enum('network_strategy_type', [
    'WB_MAXIMUM_CLICKS',        // Максимум кликов  
    'AVERAGE_CPC',              // Максимум кликов  по средней цене   
    'WB_MAXIMUM_CONVERSION_RATE', // Максимум конверсий
    'AVERAGE_CPA',              //   Максимум конверсий по средней цене
    'PAY_FOR_CONVERSION',       // Оплата за конверсию
])->nullable()->comment('Стратегия показа в сетях');


Дополниетельные поля для стратегий на для network: 

// Поля для стратегии WbMaximumClicks (Максимум кликов)
$table->decimal('network_wb_maximum_clicks_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('network_wb_maximum_clicks_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');



// Поля для стратегии AverageCpc (Максимум кликов по средней цене)

$table->decimal('network_average_cpc_average_cpc', 15, 6)
    ->nullable()
    ->comment('Средняя цена клика в валюте рекламодателя, умноженная на 1 000 000');

$table->decimal('network_average_cpc_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');




// Поля для стратегии WbMaximumConversionRate (Максимум конверсий)

$table->decimal('network_wb_maximum_conversion_rate_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('network_wb_maximum_conversion_rate_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');

$table->unsignedBigInteger('network_wb_maximum_conversion_rate_goal_id')
    ->nullable()
    ->comment('Идентификатор цели Яндекс Метрики');



// Поля для стратегии AverageCpa (Максимум конверсий по средней цене)


$table->decimal('network_average_cpa_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('network_average_cpa_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');

$table->json('network_average_cpa_exploration_budget')
    ->nullable()
    ->comment('
    {
        "MinimumExplorationBudget": 0,
        "IsMinimumExplorationBudgetCustom": "YES"
    }');

$table->unsignedBigInteger('network_average_cpa_goal_id')
    ->nullable()
    ->comment('Идентификатор цели Яндекс Метрики');

$table->decimal('network_average_cpa_average_cpa', 15, 6)
    ->nullable()
    ->comment('Средняя цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');




// Поля для стратегии AverageCpaMultipleGoals (Максимум конверсий с оплатой за клики)


$table->decimal('network_average_cpa_multiple_goals_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('network_average_cpa_multiple_goals_bid_ceiling', 15, 6)
    ->nullable()
    ->comment('Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000');

$table->json('network_average_cpa_multiple_goals_exploration_budget')
    ->nullable()
    ->comment('
    {
        "MinimumExplorationBudget": 0,
        "IsMinimumExplorationBudgetCustom": "YES"
    }');

$table->json('network_average_cpa_multiple_goals_priority_goals')
    ->nullable()
    ->comment('
    {
        "Items": [
            {
                "GoalId": 0,
                "Value": 0,
                "IsMetrikaSourceOfValue": "YES"
            }
        ]
    }');



// Поля для стратегии PayForConversion (Оплата за конверсии)

$table->decimal('network_pay_for_conversion_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->decimal('network_pay_for_conversion_cpa', 15, 6)
    ->nullable()
    ->comment('Цена достижения цели в валюте рекламодателя, умноженная на 1 000 000');

$table->unsignedBigInteger('network_pay_for_conversion_goal_id')
    ->nullable()
    ->comment('Идентификатор цели Яндекс Метрики');

// Поля для стратегии PayForConversionMultipleGoals (Максимум конверсий с оплатой за конверсии)
$table->decimal('network_pay_for_conversion_multiple_goals_weekly_spend_limit', 15, 6)
    ->nullable()
    ->comment('Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000');

$table->json('network_pay_for_conversion_multiple_goals_priority_goals')
    ->nullable()
    ->comment('
    {
        "Items": [
            {
                "GoalId": 0,
                "Value": 0,
                "IsMetrikaSourceOfValue": "YES"
            }
        ]
    }');

========================


Цели Яндекс Метрики:

// Основные поля для идентификации

campaign_id (внутрений id)

$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');

// Поле для хранения идентификаторов счетчиков Яндекс Метрики
$table->json('counter_ids')
    ->nullable()
    ->comment('
    {
        "Items": [0]  // Массив идентификаторов счетчиков Яндекс Метрики
    }');

// Для удобства поиска и фильтрации можно добавить отдельное поле для основного счетчика

$table->unsignedBigInteger('primary_counter_id')
    ->nullable()
    ->comment('Идентификатор основного счетчика Яндекс Метрики');

// Индекс для быстрого поиска
$table->index('primary_counter_id');



// Поля для приоритетных целей
$table->json('priority_goals')
    ->nullable()
    ->comment('
    {
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

// Индексы для быстрого поиска
$table->index('primary_goal_id');
$table->index('primary_goal_value');


setting_param json

===============================

Расписание показов: 

// Основные поля для идентификации

campaign_id (внутрений id)

$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');


// Базовые поля дат

$table->date('start_date')
    ->comment('Дата начала показа кампании');
$table->date('end_date')
    ->nullable()
    ->comment('Дата окончания показа кампании');

// Часовой пояс
$table->string('time_zone', 50)
    ->default('Europe/Moscow')
    ->comment('Часовой пояс в месте нахождения рекламодателя');

// Тип временного таргетинга
$table->enum('time_targeting_type', ['custom', 'budni', 'set1', 'set2', 'set3'])
    ->default('budni')
    ->comment('Тип временного таргетинга');

// JSON поля для различных наборов расписаний
$table->json('time_targeting_custom')
    ->nullable()
    ->comment('
    {
        "Schedule": [
            "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"
        ]
    }');

$table->json('time_targeting_budni')
    ->nullable()
    ->comment('
    {
        "Schedule": [
            "1,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",
            "2,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",
            "3,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",
            "4,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",
            "5,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",
            "6,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0",
            "7,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0"
        ]
    }');

$table->json('time_targeting_set1')
    ->nullable()
    ->comment('
    {
        "Schedule": [
            "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"
        ]
    }');

$table->json('time_targeting_set2')
    ->nullable()
    ->comment('
    {
        "Schedule": [
            "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"
        ]
    }');

$table->json('time_targeting_set3')
    ->nullable()
    ->comment('
    {
        "Schedule": [
            "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",
            "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"
        ]
    }');


// Настройки переноса рабочих дней
$table->enum('consider_working_weekends', ['YES', 'NO'])
    ->default('YES')
    ->comment('Менять ли расписание показов при переносе рабочего дня на субботу или воскресенье');

// Настройки показа в праздничные дни
$table->json('holidays_schedule')
    ->nullable()
    ->comment('
    {
        "SuspendOnHolidays": "YES",  // Останавливать ли объявления в праздничные нерабочие дни
        "BidPercent": 100,           // Коэффициент к ставке при показе в праздничные нерабочие дни (10-200, кратно 10)
        "StartHour": 0,              // Время начала показов в праздничные нерабочие дни (0-23)
        "EndHour": 24                // Время окончания показов в праздничные нерабочие дни (1-24)
    }');

setting_param json

===================

Корректировки ставок:


// Основные поля для идентификации

campaign_id (внутрений id)
ad_group_id (внутрений id)


$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');

$table->unsignedBigInteger('yandex_ad_group_id')
    ->nullable()
    ->comment('Идентификатор группы объявлений');

// Корректировки для мобильных устройств
$table->json('mobile_adjustment')
    ->nullable()
    ->comment('
    {
        "BidModifier": 100,          // Значение коэффициента к ставке (0-1300)
        "OperatingSystemType": null  // Тип операционной системы
    }');

// Корректировки для планшетов
$table->json('tablet_adjustment')
    ->nullable()
    ->comment('
    {
        "BidModifier": 100,          // Значение коэффициента к ставке (0-1300)
        "OperatingSystemType": null  // Тип операционной системы
    }');

// Корректировки для компьютеров и Smart TV
$table->json('desktop_adjustment')
    ->nullable()
    ->comment('
    {
        "BidModifier": 100  // Значение коэффициента к ставке (0-1300)
    }');

// Корректировки только для компьютеров
$table->json('desktop_only_adjustment')
    ->nullable()
    ->comment('
    {
        "BidModifier": 100  // Значение коэффициента к ставке (0-1300)
    }');

// Корректировки по полу и возрасту
$table->json('demographics_adjustments')
    ->nullable()
    ->comment('
    {
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
    ->comment('
    {
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
    ->comment('
    {
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
    ->comment('
    {
        "BidModifier": 100  // Значение коэффициента к ставке (50-1300)
    }');

// Корректировка для смарт-объявлений
$table->json('smart_ad_adjustment')
    ->nullable()
    ->comment('
    {
        "BidModifier": 100  // Значение коэффициента к ставке (20-1300)
    }');

// Корректировки на эксклюзивное размещение
$table->json('serp_layout_adjustments')
    ->nullable()
    ->comment('
    {
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
    ->comment('
    {
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
    ->comment('
    {
        "BidModifier": 100  // Значение коэффициента к ставке (1-1300)
    }');

setting_param json
===================

Минус фразы: 

// Основные поля для идентификации

campaign_id (внутрений id)
ad_group_id (внутрений id)


$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');

$table->unsignedBigInteger('yandex_ad_group_id')
    ->nullable()
    ->comment('Идентификатор группы объявлений');

// Минус-фразы
$table->json('negative_keywords')
    ->nullable()
    ->comment('
    {
        "Items": []  // Массив минус-фраз, общих для всех ключевых фраз кампании
    }');


setting_param json
===================

// Заблокированные IP-адреса
// Основные поля для идентификации

campaign_id (внутрений id)

$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');

$table->json('blocked_ips')
    ->nullable()
    ->comment('
    {
        "Items": []  // Массив IP-адресов, которым не нужно показывать объявления
    }');

// Исключенные места показа
$table->json('excluded_sites')
    ->nullable()
    ->comment('
    {
        "Items": []  // Массив мест показа, где не нужно показывать объявления
    }');

setting_param json
==============================

дополнительные настройки кампании:

campaign_id (внутрений id)

$table->unsignedBigInteger('yandex_campaign_id')
    ->nullable()
    ->comment('Идентификатор кампании');


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

setting_param json