# Сопоставление полей форм и базы данных

## Основные настройки кампании (basic_settings.blade.php)

| Поле в форме | Поле в БД | Обязательное | Статус | Примечания |
|--------------|-----------|--------------|--------|------------|
| name | name | ✅ | ✅ | Название кампании |
| status | status | ✅ | ✅ | Статус кампании (active/paused/stopped) |
| url | url | ✅ | ✅ | Рекламируемая страница |

## Места показа (advanced_settings.blade.php)

| Поле в форме | Поле в БД | Обязательное | Статус | Примечания |
|--------------|-----------|--------------|--------|------------|
| platforms[ProductGallery] | search_placement_types | - | ✅ | Товарная галерея на поиске |
| platforms[SearchResult] | search_placement_types | - | ✅ | Реклама в поисковой выдаче |
| platforms[DynamicPlaces] | search_placement_types | - | ✅ | Динамические места на поиске |
| platforms[SearchOrganizationList] | search_placement_types | - | ✅ | Список организаций в результатах поиска |
| platforms[Network] | network_placement_types | - | ✅ | Рекламная сеть Яндекса |
| platforms[Maps] | network_placement_types | - | ✅ | Яндекс Карты |

## Стратегия (advanced_settings.blade.php)

| Поле в форме | Поле в БД | Обязательное | Статус | Примечания |
|--------------|-----------|--------------|--------|------------|
| strategy_type | search_bidding_strategy_type | ✅ | ✅ | Тип стратегии для поиска |
| weekly_budget | weekly_budget | - | ✅ | Бюджет в неделю |
| max_clicks_average_cpc | max_clicks_average_cpc | - | ✅ | Средняя цена клика |
| max_conversions_payment_type | search_bidding_strategy | - | ✅ | Тип оплаты для максимум конверсий |
| max_conversions_clicks_crr | search_bidding_strategy | - | ✅ | Доля рекламных расходов для кликов |
| max_conversions_conversions_crr | search_bidding_strategy | - | ✅ | Доля рекламных расходов для конверсий |
| daily_budget | daily_budget_amount | - | ✅ | Дневной бюджет |

## Цели Яндекс Метрики (advanced_settings.blade.php)

| Поле в форме | Поле в БД | Обязательное | Статус | Примечания |
|--------------|-----------|--------------|--------|------------|
| counter_ids[] | counter_ids | - | ✅ | Счетчики Яндекс.Метрики |
| goals[] | priority_goals | - | ✅ | Цели |

## Статусы:
- ✅ - Поле присутствует в форме и соответствует БД
- ❌ - Поле отсутствует в форме
- 🔄 - Поле требует переименования
- 📝 - Поле требует дополнительной настройки

## Анализ:
1. В форме basic_settings.blade.php реализованы только базовые поля:
   - name (обязательное)
   - status (обязательное)
   - url (обязательное)

2. В форме advanced_settings.blade.php реализованы:
   - Места показа (все типы размещения)
   - Стратегии (основные параметры)
   - Цели Яндекс Метрики

3. Отсутствуют в формах, но есть в БД:
   - Настройки уведомлений (sms_settings, email_settings)
   - Ограничения (negative_keywords, blocked_ips, excluded_sites)
   - Настройки таргетинга по времени
   - Дополнительные настройки кампании
   - Параметры пакетного назначения ставок

4. Особенности реализации:
   - JSON-поля в БД хранят структурированные данные из форм
   - Зависимости между полями реализованы через JavaScript
   - Множественный выбор реализован через Select2
   - Валидация обязательных полей присутствует 