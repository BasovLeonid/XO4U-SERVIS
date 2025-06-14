# Документация по интерфейсу Яндекс Директ
Дата создания: 2024-03-19

## Структура UnifiedCampaignPlatforms

### Поиск
1. **ProductGallery** (Товарная галерея)
   - Тип: YesNoEnum
   - Описание: Показ предложений в карусели товаров над результатами поиска
   - Значение по умолчанию: Да
   - Доступные стратегии: Максимум кликов, Максимум конверсий, Максимум кликов с ручным управлением

2. **SearchResult** (Поисковая выдача)
   - Тип: YesNoEnum
   - Описание: Размещение объявлений в специальных рекламных блоках на страницах результатов поиска
   - Значение по умолчанию: Да
   - Доступные стратегии: Максимум кликов, Максимум конверсий, Максимум кликов с ручным управлением

3. **DynamicPlaces** (Динамические места)
   - Тип: YesNoEnum
   - Описание: Повышение видимости страниц в поиске по товарам и услугам
   - Значение по умолчанию: Да
   - Доступные стратегии: Максимум кликов, Максимум конверсий, Максимум кликов с ручным управлением
   - Зависимость: Требуется включенный SearchResult

4. **SearchOrganizationList** (Список организаций)
   - Тип: YesNoEnum
   - Описание: Показ в списке организаций из Яндекс Бизнеса над результатами поиска
   - Значение по умолчанию: Нет
   - Доступные стратегии: Максимум кликов, Максимум конверсий, Максимум кликов с ручным управлением

### Другие площадки
1. **Network** (Рекламная сеть)
   - Тип: YesNoEnum
   - Описание: Показ на сайтах и в приложениях рекламной сети Яндекса
   - Значение по умолчанию: Да
   - Доступные стратегии: Максимум кликов, Максимум конверсий

2. **Maps** (Яндекс Карты)
   - Тип: YesNoEnum
   - Описание: Показ в поиске Карт с зеленой меткой
   - Значение по умолчанию: Нет
   - Доступные стратегии: Максимум кликов, Максимум конверсий

## Структура интерфейса создания кампании

### Основные настройки кампании
1. **Название кампании**
   - Тип поля: text
   - Обязательное: Да
   - Валидация: required

2. **Статус кампании**
   - Тип поля: select
   - Обязательное: Да
   - Значения:
     - active (Активна)
     - paused (На паузе)
     - stopped (Остановлена)

3. **Рекламируемая страница**
   - Тип поля: url
   - Обязательное: Да
   - Валидация: required, url

### Места показа
1. **Раздел "Поиск"**
   - ProductGallery
     - Тип: checkbox
     - Значение: YES
     - Описание: "Покажите свои предложения в карусели товаров из разных магазинов, которая появляется над результатами поиска"

   - SearchResult
     - Тип: checkbox
     - Значение: YES
     - Описание: "Разместите свои объявления в специальных рекламных блоках на страницах результатов поиска"

   - DynamicPlaces
     - Тип: checkbox
     - Значение: YES
     - Описание: "Получайте дополнительные конверсии, повышая видимость своих страниц в поиске по товарам и услугам"
     - Зависимость: Требуется включенный SearchResult

   - SearchOrganizationList
     - Тип: checkbox
     - Значение: YES
     - Описание: "Станьте заметнее среди других организаций из Яндекс Бизнеса, которые появляются над результатами поиска"

2. **Раздел "Другие площадки"**
   - Network
     - Тип: checkbox
     - Значение: YES
     - Описание: "Охватите посетителей десятков тысяч сайтов и приложений, которым могут быть интересны ваши товары и услуги"

   - Maps
     - Тип: checkbox
     - Значение: YES
     - Описание: "Поднимитесь в поиске Карт и выделитесь среди других организаций благодаря зелёной метке"

### Стратегия
1. **Тип стратегии**
   - Тип поля: select
   - Обязательное: Да
   - Значения:
     - max_clicks (Максимум кликов)
     - max_conversions (Максимум конверсий)
     - max_clicks_manual (Максимум кликов с ручным управлением)

2. **Максимум кликов**
   - Бюджет в неделю (руб.)
     - Тип поля: number
     - Обязательное: Да
     - Валидация: required, numeric, min:0
   
   - С оплатой
     - Тип поля: select
     - Значение по умолчанию: За клики
     - Значения: За клики
   
   - Ограничение расхода
     - Тип поля: select
     - Значения:
       - budget (Бюджет)
       - average_cpc (Средняя цена клика)
     - Дополнительные поля:
       - Средняя цена клика (руб.) - появляется при выборе average_cpc

3. **Максимум конверсий**
   - С оплатой
     - Тип поля: select
     - Значения:
       - clicks (За клики)
       - conversions (За конверсии)
   
   - Настройки для оплаты за клики:
     - Ограничение расхода
       - Тип поля: select
       - Значения:
         - budget (Бюджет)
         - average_cpa (Средняя цена конверсии)
         - crr (Доля рекламных расходов)
       - Дополнительные поля:
         - Доля рекламных расходов (%) - появляется при выборе crr
   
   - Настройки для оплаты за конверсии:
     - Ограничение расхода
       - Тип поля: select
       - Значения:
         - cpa (Цена конверсии)
         - crr (Доля рекламных расходов)
       - Дополнительные поля:
         - Доля рекламных расходов (%) - появляется при выборе crr
   
   - Бюджет в неделю (руб.)
     - Тип поля: number
     - Обязательное: Да
     - Валидация: required, numeric, min:0

4. **Максимум кликов с ручным управлением**
   - Дневной бюджет (руб.)
     - Тип поля: number
     - Обязательное: Да
     - Валидация: required, numeric, min:0

## Структура данных
```php
[
    'name' => 'string',
    'status' => 'enum:active,paused,stopped',
    'url' => 'url',
    'platforms' => [
        'ProductGallery' => 'YesNoEnum',
        'SearchResult' => 'YesNoEnum',
        'DynamicPlaces' => 'YesNoEnum',
        'SearchOrganizationList' => 'YesNoEnum',
        'Network' => 'YesNoEnum',
        'Maps' => 'YesNoEnum'
    ],
    'strategy_type' => 'enum:max_clicks,max_conversions,max_clicks_manual',
    'weekly_budget' => 'decimal:2',
    'daily_budget' => 'decimal:2',
    'max_clicks_payment_type' => 'enum:clicks',
    'max_clicks_limit_type' => 'enum:budget,average_cpc',
    'max_clicks_average_cpc' => 'decimal:2',
    'max_conversions_payment_type' => 'enum:clicks,conversions',
    'max_conversions_clicks_limit_type' => 'enum:budget,average_cpa,crr',
    'max_conversions_clicks_crr' => 'decimal:2',
    'max_conversions_conversions_limit_type' => 'enum:cpa,crr',
    'max_conversions_conversions_crr' => 'decimal:2',
    'max_conversions_weekly_budget' => 'decimal:2'
]
```

## Примечания
- Все чекбоксы используют структуру `platforms[KeyName]` для имен полей
- Значения чекбоксов: YES/NO
- Состояние чекбоксов сохраняется через `old()` хелпер
- Интерфейс разделен на визуальные блоки с заголовками
- Каждый чекбокс имеет основное описание и дополнительное пояснение
- Доступность стратегий зависит от выбранных площадок
- Динамические места на поиске можно выбрать только при включенной поисковой выдаче
- При выборе стратегии "Максимум кликов" поле "С оплатой" всегда установлено на "За клики" 