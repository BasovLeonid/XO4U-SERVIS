# Сводная таблица полей Яндекс.Директ

## Основные настройки кампании

| Поле в API Яндекс.Директ | Поле в БД | Поле в форме | Статус | Примечания |
|-------------------------|-----------|--------------|---------|------------|
| Name | name | name | ✅ БД + ✅ Форма | Название кампании |
| Status | status | status | ✅ БД + ✅ Форма | Статус кампании (active/draft) |
| StartDate | start_date | start_date | ✅ БД + ✅ Форма | Дата начала кампании |
| EndDate | end_date | end_date | ✅ БД + ✅ Форма | Дата окончания кампании |
| DailyBudget | daily_budget_amount | daily_budget_amount | ✅ БД + ✅ Форма | Дневной бюджет |
| DailyBudgetMode | daily_budget_mode | daily_budget_mode | ✅ БД + ✅ Форма | Режим дневного бюджета |
| ClientInfo | client_info | - | ❌ БД + ❌ Форма | Информация о клиенте |
| TimeZone | time_zone | - | ❌ БД + ❌ Форма | Часовой пояс |
| Notification.SmsSettings.Events | notification_sms_events | - | ❌ БД + ❌ Форма | События для SMS-уведомлений |
| Notification.SmsSettings.TimeFrom | notification_sms_time_from | - | ❌ БД + ❌ Форма | Время начала SMS-уведомлений |
| Notification.SmsSettings.TimeTo | notification_sms_time_to | - | ❌ БД + ❌ Форма | Время окончания SMS-уведомлений |
| Notification.EmailSettings.Email | notification_email | - | ❌ БД + ❌ Форма | Email для уведомлений |
| Notification.EmailSettings.CheckPositionInterval | notification_check_position_interval | - | ❌ БД + ❌ Форма | Интервал проверки позиций |
| Notification.EmailSettings.WarningBalance | notification_warning_balance | - | ❌ БД + ❌ Форма | Баланс для предупреждений |
| Notification.EmailSettings.SendAccountNews | notification_send_account_news | - | ❌ БД + ❌ Форма | Отправка новостей аккаунта |
| Notification.EmailSettings.SendWarnings | notification_send_warnings | - | ❌ БД + ❌ Форма | Отправка предупреждений |
| NegativeKeywords.Items | negative_keywords | - | ❌ БД + ❌ Форма | Минус-слова |
| BlockedIps.Items | blocked_ips | - | ❌ БД + ❌ Форма | Заблокированные IP |
| ExcludedSites.Items | excluded_sites | - | ❌ БД + ❌ Форма | Исключенные сайты |
| TimeTargeting.Schedule.Items | time_targeting_schedule | - | ❌ БД + ❌ Форма | Расписание показов |
| TimeTargeting.ConsiderWorkingWeekends | time_targeting_consider_weekends | - | ❌ БД + ❌ Форма | Учет выходных |
| TimeTargeting.HolidaysSchedule.SuspendOnHolidays | time_targeting_suspend_holidays | - | ❌ БД + ❌ Форма | Приостановка в праздники |
| TimeTargeting.HolidaysSchedule.BidPercent | time_targeting_holidays_bid_percent | - | ❌ БД + ❌ Форма | Процент ставки в праздники |
| TimeTargeting.HolidaysSchedule.StartHour | time_targeting_holidays_start_hour | - | ❌ БД + ❌ Форма | Час начала в праздники |
| TimeTargeting.HolidaysSchedule.EndHour | time_targeting_holidays_end_hour | - | ❌ БД + ❌ Форма | Час окончания в праздники |


## параметры UnifiedCampaign

### BiddingStrategy.Search
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| BiddingStrategyType | enum | ✅ | AVERAGE_CPC, AVERAGE_CPA, PAY_FOR_CONVERSION, WB_MAXIMUM_CONVERSION_RATE, HIGHEST_POSITION, SERVING_OFF, WB_MAXIMUM_CLICKS, AVERAGE_CRR, PAY_FOR_CONVERSION_CRR |
| PlacementTypes.SearchResults | enum | - | YES, NO |
| PlacementTypes.ProductGallery | enum | - | YES, NO |
| PlacementTypes.DynamicPlaces | enum | - | YES, NO |
| PlacementTypes.Maps | enum | - | YES, NO |
| PlacementTypes.SearchOrganizationList | enum | - | YES, NO |

### BiddingStrategy.Network
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| BiddingStrategyType | enum | ✅ | AVERAGE_CPC, AVERAGE_CPA, PAY_FOR_CONVERSION, WB_MAXIMUM_CONVERSION_RATE, NETWORK_DEFAULT, SERVING_OFF, WB_MAXIMUM_CLICKS, AVERAGE_CRR, PAY_FOR_CONVERSION_CRR |
| PlacementTypes.Network | enum | ✅ | YES, NO |
| PlacementTypes.Maps | enum | - | YES, NO |

### Общие параметры стратегий
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| WeeklySpendLimit | long | ✅ | Недельный лимит расходов |
| BidCeiling | long | - | Максимальная ставка |
| CustomPeriodBudget.SpendLimit | long | - | Лимит расходов за период |
| CustomPeriodBudget.StartDate | string | - | Дата начала периода |
| CustomPeriodBudget.EndDate | string | - | Дата окончания периода |
| CustomPeriodBudget.AutoContinue | enum | - | YES, NO |

### Специфические параметры стратегий
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| AverageCpc.AverageCpc | long | ✅ | Средняя ставка за клик |
| AverageCpa.AverageCpa | long | ✅ | Средняя ставка за конверсию |
| AverageCpa.GoalId | long | ✅ | ID цели |
| PayForConversion.Cpa | long | ✅ | Ставка за конверсию |
| PayForConversion.GoalId | long | ✅ | ID цели |
| AverageCrr.Crr | integer | ✅ | Целевой показатель конверсии |
| AverageCrr.GoalId | long | ✅ | ID цели |
| PayForConversionCrr.Crr | integer | ✅ | Целевой показатель конверсии |
| PayForConversionCrr.GoalId | long | ✅ | ID цели |

### ExplorationBudget
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| MinimumExplorationBudget | long | ✅ | Минимальный бюджет на исследование |
| IsMinimumExplorationBudgetCustom | enum | ✅ | YES, NO |

### Settings
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| Option | enum | ✅ | ADD_METRICA_TAG, ADD_TO_FAVORITES, ENABLE_AREA_OF_INTEREST_TARGETING, ENABLE_SITE_MONITORING, REQUIRE_SERVICING, ENABLE_COMPANY_INFO, CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED, ALTERNATIVE_TEXTS_ENABLED |
| Value | enum | ✅ | YES, NO |

### Дополнительные параметры
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| CounterIds.Items | array | ✅ | Массив ID счетчиков |
| PriorityGoals.Items.GoalId | long | ✅ | ID цели |
| PriorityGoals.Items.Value | long | ✅ | Значение |
| PriorityGoals.Items.IsMetrikaSourceOfValue | enum | - | YES, NO |
| TrackingParams | string | - | Параметры отслеживания |
| AttributionModel | enum | - | LC, LSC, FC, LYDC, LSCCD, FCCD, LYDCCD, AUTO |
| PackageBiddingStrategy.StrategyId | long | - | ID стратегии |
| PackageBiddingStrategy.StrategyFromCampaignId | long | - | ID кампании-источника стратегии |
| PackageBiddingStrategy.Platforms.SearchResult | enum | ✅ | YES, NO |
| PackageBiddingStrategy.Platforms.ProductGallery | enum | ✅ | YES, NO |
| PackageBiddingStrategy.Platforms.Maps | enum | - | YES, NO |
| PackageBiddingStrategy.Platforms.SearchOrganizationList | enum | - | YES, NO |
| PackageBiddingStrategy.Platforms.Network | enum | ✅ | YES, NO |
| PackageBiddingStrategy.Platforms.DynamicPlaces | enum | - | YES, NO |
| NegativeKeywordSharedSetIds.Items | array | ✅ | Массив ID наборов минус-слов |

## Статусы:
- ✅ БД + ✅ Форма - Поле добавлено и в БД, и в форму
- ❌ БД + ✅ Форма - Поле есть в форме, но отсутствует в БД
- ✅ БД + ❌ Форма - Поле есть в БД, но отсутствует в форме
- ❌ БД + ❌ Форма - Поле отсутствует и в БД, и в форме

## Необходимые изменения:
1. Переименовать поля в форме с `platforms` на `search_placement_types`
2. Обновить названия стратегий в форме:
   - `max_clicks` -> `WB_MAXIMUM_CLICKS`
   - `max_conversions` -> `WB_MAXIMUM_CONVERSION_RATE`
   - `max_clicks_manual` -> `AVERAGE_CPC`
3. Обновить структуру полей для стратегий:
   - `weekly_budget` -> `search_bidding_strategy[WeeklySpendLimit]`
   - `max_clicks_average_cpc` -> `search_bidding_strategy[AverageCpc]`

# Метод add - Создание кампаний

## Ограничения метода
- Не более 10 кампаний в одном вызове
- Ограничения на количество кампаний через Clients.get или AgencyClients.get (CAMPAIGNS_TOTAL_PER_CLIENT, CAMPAIGNS_UNARCHIVED_PER_CLIENT)

## Структура запроса

### CampaignAddItem
| Поле | Тип | Обязательное | Описание |
|------|-----|--------------|-----------|
| ClientInfo | string | - | - |
| Notification.SmsSettings.Events | array | - | MONITORING, FINISHED |
| Notification.SmsSettings.TimeFrom | string | - | - |
| Notification.SmsSettings.TimeTo | string | - | - |
| Notification.EmailSettings.Email | string | - | - |
| Notification.EmailSettings.CheckPositionInterval | int | - | - |
| Notification.EmailSettings.WarningBalance | int | - | - |
| Notification.EmailSettings.SendAccountNews | enum | - | YES, NO |
| Notification.EmailSettings.SendWarnings | enum | - | YES, NO |
| TimeZone | string | - | - |
| Name | string | ✅ | - |
| StartDate | string | ✅ | - |
| DailyBudget.Amount | long | ✅ | - |
| DailyBudget.Mode | enum | ✅ | STANDARD, DISTRIBUTED |
| EndDate | string | - | - |
| NegativeKeywords.Items | array | ✅ | - |
| BlockedIps.Items | array | ✅ | - |
| ExcludedSites.Items | array | ✅ | - |
| TextCampaign | object | - | TextCampaignAddItem |
| MobileAppCampaign | object | - | MobileAppCampaignAddItem |
| DynamicTextCampaign | object | - | DynamicTextCampaignAddItem |
| CpmBannerCampaign | object | - | CpmBannerCampaignAddItem |
| SmartCampaign | object | - | SmartCampaignAddItem |
| UnifiedCampaign | object | - | UnifiedCampaignAddItem |
| TimeTargeting.Schedule.Items | array | ✅ | - |
| TimeTargeting.ConsiderWorkingWeekends | enum | ✅ | YES, NO |
| TimeTargeting.HolidaysSchedule.SuspendOnHolidays | enum | ✅ | YES, NO |
| TimeTargeting.HolidaysSchedule.BidPercent | int | - | - |
| TimeTargeting.HolidaysSchedule.StartHour | int | - | - |
| TimeTargeting.HolidaysSchedule.EndHour | int | - | - |

## Типы кампаний

| Тип кампании | Описание |
|--------------|-----------|
| TextCampaign | Текстовая кампания |
| MobileAppCampaign | Кампания для мобильных приложений |
| DynamicTextCampaign | Динамическая текстовая кампания |
| CpmBannerCampaign | CPM-баннерная кампания |
| SmartCampaign | Умная кампания |
| UnifiedCampaign | Универсальная кампания |

## Ограничения метода
- Не более 10 кампаний в одном вызове метода
- Ограничение на количество кампаний для рекламодателя можно получить через методы:
  - Clients.get
  - AgencyClients.get
  (элементы CAMPAIGNS_TOTAL_PER_CLIENT и CAMPAIGNS_UNARCHIVED_PER_CLIENT массива Restrictions) 