# Сопоставление полей API Яндекс.Директ и полей в базе данных

## Основные настройки кампании

| Поле в API | Поле в БД | Статус | Примечания |
|------------|-----------|--------|------------|
| Name | name | ✅ | Название кампании |
| Status | status | ✅ | Статус кампании (active/draft) |
| StartDate | start_date | ✅ | Дата начала кампании |
| EndDate | end_date | ✅ | Дата окончания кампании |
| DailyBudget | daily_budget_amount | ✅ | Дневной бюджет |
| DailyBudgetMode | daily_budget_mode | ✅ | Режим дневного бюджета |
| ClientInfo | client_info | ✅ | Информация о клиенте |
| TimeZone | time_zone | ✅ | Часовой пояс |
| Notification.SmsSettings.Events | sms_settings | ✅ | События для SMS-уведомлений (в JSON) |
| Notification.SmsSettings.TimeFrom | sms_settings | ✅ | Время начала SMS-уведомлений (в JSON) |
| Notification.SmsSettings.TimeTo | sms_settings | ✅ | Время окончания SMS-уведомлений (в JSON) |
| Notification.EmailSettings.Email | email_settings | ✅ | Email для уведомлений (в JSON) |
| Notification.EmailSettings.CheckPositionInterval | email_settings | ✅ | Интервал проверки позиций (в JSON) |
| Notification.EmailSettings.WarningBalance | email_settings | ✅ | Баланс для предупреждений (в JSON) |
| Notification.EmailSettings.SendAccountNews | email_settings | ✅ | Отправка новостей аккаунта (в JSON) |
| Notification.EmailSettings.SendWarnings | email_settings | ✅ | Отправка предупреждений (в JSON) |
| NegativeKeywords.Items | negative_keywords | ✅ | Минус-слова (в JSON) |
| BlockedIps.Items | blocked_ips | ✅ | Заблокированные IP (в JSON) |
| ExcludedSites.Items | excluded_sites | ✅ | Исключенные сайты (в JSON) |
| TimeTargeting.Schedule.Items | time_targeting_schedule | ✅ | Расписание показов (в JSON) |
| TimeTargeting.ConsiderWorkingWeekends | consider_working_weekends | ✅ | Учет выходных |
| TimeTargeting.HolidaysSchedule.SuspendOnHolidays | holidays_schedule | ✅ | Приостановка в праздники (в JSON) |
| TimeTargeting.HolidaysSchedule.BidPercent | holidays_schedule | ✅ | Процент ставки в праздники (в JSON) |
| TimeTargeting.HolidaysSchedule.StartHour | holidays_schedule | ✅ | Час начала в праздники (в JSON) |
| TimeTargeting.HolidaysSchedule.EndHour | holidays_schedule | ✅ | Час окончания в праздники (в JSON) |

## Параметры UnifiedCampaign

### BiddingStrategy.Search
| Поле в API | Поле в БД | Статус | Примечания |
|------------|-----------|--------|------------|
| BiddingStrategyType | search_bidding_strategy_type | ✅ | Тип стратегии для поиска |
| PlacementTypes.SearchResults | search_placement_types | ✅ | Поисковая выдача (в JSON) |
| PlacementTypes.ProductGallery | search_placement_types | ✅ | Галерея товаров (в JSON) |
| PlacementTypes.DynamicPlaces | search_placement_types | ✅ | Динамические места (в JSON) |
| PlacementTypes.Maps | search_placement_types | ✅ | Карты (в JSON) |
| PlacementTypes.SearchOrganizationList | search_placement_types | ✅ | Список организаций (в JSON) |
| WeeklySpendLimit | weekly_budget | ✅ | Недельный лимит расходов |
| AverageCpc.AverageCpc | max_clicks_average_cpc | ✅ | Средняя ставка за клик |

### BiddingStrategy.Network
| Поле в API | Поле в БД | Статус | Примечания |
|------------|-----------|--------|------------|
| BiddingStrategyType | network_bidding_strategy_type | ✅ | Тип стратегии для сети |
| PlacementTypes.Network | network_placement_types | ✅ | Рекламная сеть (в JSON) |
| PlacementTypes.Maps | network_placement_types | ✅ | Карты (в JSON) |

### Дополнительные настройки
| Поле в API | Поле в БД | Статус | Примечания |
|------------|-----------|--------|------------|
| Settings | campaign_settings | ✅ | Настройки кампании (в JSON) |
| Settings.Option | campaign_settings_option | ✅ | Опция настройки |
| CounterIds.Items | counter_ids | ✅ | ID счетчиков (в JSON) |
| PriorityGoals.Items | priority_goals | ✅ | Приоритетные цели (в JSON) |
| TrackingParams | tracking_params | ✅ | Параметры отслеживания |
| AttributionModel | attribution_model | ✅ | Модель атрибуции |
| PackageBiddingStrategy | package_bidding_strategy | ✅ | Стратегия пакетного назначения ставок (в JSON) |
| PackageBiddingStrategy.Platforms | package_bidding_platforms | ✅ | Платформы для пакетного назначения ставок (в JSON) |
| NegativeKeywordSharedSetIds.Items | negative_keyword_shared_set_ids | ✅ | ID наборов минус-слов (в JSON) |

## Служебные поля
| Поле в API | Поле в БД | Статус | Примечания |
|------------|-----------|--------|------------|
| - | template_id | ✅ | ID шаблона |
| - | campaign_type | ✅ | Тип кампании |
| - | created_at | ✅ | Дата создания |
| - | updated_at | ✅ | Дата обновления |
| - | deleted_at | ✅ | Дата удаления |

## Статусы:
- ✅ - Поле присутствует в БД и соответствует API
- ❌ - Поле отсутствует в БД
- 🔄 - Поле требует переименования
- 📝 - Поле требует дополнительной настройки

## Необходимые изменения:
1. Все поля присутствуют в базе данных
2. JSON-поля корректно хранят структурированные данные
3. ENUM-поля соответствуют допустимым значениям API
4. Служебные поля (created_at, updated_at, deleted_at) присутствуют 