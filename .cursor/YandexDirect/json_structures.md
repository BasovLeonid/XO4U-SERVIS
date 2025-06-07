# JSON структуры данных

## Базовый запрос API

### Структура запроса
```json
{
  "method": "add",
  "params": {
    "Campaigns": [{
      "ClientInfo": "string",
      "Notification": {
        "SmsSettings": {
          "Events": ["MONITORING", "FINISHED"],
          "TimeFrom": "string",
          "TimeTo": "string"
        },
        "EmailSettings": {
          "Email": "string",
          "CheckPositionInterval": 0,
          "WarningBalance": 0,
          "SendAccountNews": "YES",
          "SendWarnings": "YES"
        }
      },
      "TimeZone": "string",
      "Name": "string", /* required */
      "StartDate": "string", /* required */
      "DailyBudget": {
        "Amount": 0, /* required */
        "Mode": "STANDARD" /* required */
      },
      "EndDate": "string",
      "NegativeKeywords": {
        "Items": ["string"] /* required */
      },
      "BlockedIps": {
        "Items": ["string"] /* required */
      },
      "ExcludedSites": {
        "Items": ["string"] /* required */
      },
      "TimeTargeting": {
        "Schedule": {
          "Items": ["string"] /* required */
        },
        "ConsiderWorkingWeekends": "YES", /* required */
        "HolidaysSchedule": {
          "SuspendOnHolidays": "YES", /* required */
          "BidPercent": 0,
          "StartHour": 0,
          "EndHour": 0
        }
      },
      "UnifiedCampaign": {
        "BiddingStrategy": {
          "Search": {
            "BiddingStrategyType": "AVERAGE_CPC", /* required */
            "PlacementTypes": {
              "SearchResults": "YES",
              "ProductGallery": "YES",
              "DynamicPlaces": "YES",
              "Maps": "YES",
              "SearchOrganizationList": "YES"
            },
            "WbMaximumClicks": {
              "WeeklySpendLimit": 0, /* required */
              "BidCeiling": 0,
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "WbMaximumConversionRate": {
              "WeeklySpendLimit": 0, /* required */
              "BidCeiling": 0,
              "GoalId": 0, /* required */
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "AverageCpc": {
              "AverageCpc": 0, /* required */
              "WeeklySpendLimit": 0,
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "AverageCpa": {
              "AverageCpa": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0,
              "BidCeiling": 0,
              "ExplorationBudget": {
                "MinimumExplorationBudget": 0, /* required */
                "IsMinimumExplorationBudgetCustom": "YES" /* required */
              },
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "PayForConversion": {
              "Cpa": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0,
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "AverageCrr": {
              "Crr": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0,
              "ExplorationBudget": {
                "MinimumExplorationBudget": 0, /* required */
                "IsMinimumExplorationBudgetCustom": "YES" /* required */
              },
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "PayForConversionCrr": {
              "Crr": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0,
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            }
          },
          "Network": {
            "BiddingStrategyType": "AVERAGE_CPC", /* required */
            "PlacementTypes": {
              "Network": "YES",
              "Maps": "YES"
            },
            "WbMaximumClicks": {
              "WeeklySpendLimit": 0, /* required */
              "BidCeiling": 0,
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "WbMaximumConversionRate": {
              "WeeklySpendLimit": 0, /* required */
              "BidCeiling": 0,
              "GoalId": 0, /* required */
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "AverageCpc": {
              "AverageCpc": 0, /* required */
              "WeeklySpendLimit": 0,
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "AverageCpa": {
              "AverageCpa": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0,
              "BidCeiling": 0,
              "ExplorationBudget": {
                "MinimumExplorationBudget": 0, /* required */
                "IsMinimumExplorationBudgetCustom": "YES" /* required */
              },
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "PayForConversion": {
              "Cpa": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0
            },
            "AverageCrr": {
              "Crr": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0,
              "ExplorationBudget": {
                "MinimumExplorationBudget": 0, /* required */
                "IsMinimumExplorationBudgetCustom": "YES" /* required */
              },
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            },
            "PayForConversionCrr": {
              "Crr": 0, /* required */
              "GoalId": 0, /* required */
              "WeeklySpendLimit": 0,
              "CustomPeriodBudget": {
                "SpendLimit": 0,
                "StartDate": "string",
                "EndDate": "string",
                "AutoContinue": "YES"
              }
            }
          }
        },
        "Settings": [{
          "Option": "ADD_METRICA_TAG", /* required */
          "Value": "YES" /* required */
        }],
        "CounterIds": {
          "Items": [0] /* required */
        },
        "PriorityGoals": {
          "Items": [{
            "GoalId": 0, /* required */
            "Value": 0, /* required */
            "IsMetrikaSourceOfValue": "YES"
          }] /* required */
        },
        "TrackingParams": "string",
        "AttributionModel": "LC",
        "PackageBiddingStrategy": {
          "StrategyId": 0,
          "StrategyFromCampaignId": 0,
          "Platforms": {
            "SearchResult": "YES", /* required */
            "ProductGallery": "YES", /* required */
            "Maps": "YES",
            "SearchOrganizationList": "YES",
            "Network": "YES", /* required */
            "DynamicPlaces": "YES"
          } /* required */
        },
        "NegativeKeywordSharedSetIds": {
          "Items": [0] /* required */
        }
      }
    }]
  }
}
```

### Типы кампаний
В запросе может быть указан только один из следующих типов кампаний:
- TextCampaign
- MobileAppCampaign
- DynamicTextCampaign
- CpmBannerCampaign
- SmartCampaign
- UnifiedCampaign

### Доступные значения для полей

#### BiddingStrategyType для Search
- AVERAGE_CPC
- AVERAGE_CPA
- PAY_FOR_CONVERSION
- WB_MAXIMUM_CONVERSION_RATE
- HIGHEST_POSITION
- SERVING_OFF
- WB_MAXIMUM_CLICKS
- AVERAGE_CRR
- PAY_FOR_CONVERSION_CRR

#### BiddingStrategyType для Network
- AVERAGE_CPC
- AVERAGE_CPA
- PAY_FOR_CONVERSION
- WB_MAXIMUM_CONVERSION_RATE
- NETWORK_DEFAULT
- SERVING_OFF
- WB_MAXIMUM_CLICKS
- AVERAGE_CRR
- PAY_FOR_CONVERSION_CRR

#### Settings.Option
- ADD_METRICA_TAG
- ADD_TO_FAVORITES
- ENABLE_AREA_OF_INTEREST_TARGETING
- ENABLE_SITE_MONITORING
- REQUIRE_SERVICING
- ENABLE_COMPANY_INFO
- CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED
- ALTERNATIVE_TEXTS_ENABLED

#### AttributionModel
- LC
- LSC
- FC
- LYDC
- LSCCD
- FCCD
- LYDCCD
- AUTO

## Структуры в базе данных

### Настройки уведомлений
```json
// sms_settings
{
    "Events": ["MONITORING", "FINISHED"],
    "TimeFrom": "09:00",
    "TimeTo": "18:00"
}

// email_settings
{
    "Email": "example@domain.com",
    "CheckPositionInterval": 60,
    "WarningBalance": 1000,
    "SendAccountNews": "YES",
    "SendWarnings": "YES"
}
```

### Ограничения
```json
// negative_keywords
{
    "Items": ["минус", "слово", "пример"]
}

// blocked_ips
{
    "Items": ["192.168.1.1", "10.0.0.1"]
}

// excluded_sites
{
    "Items": ["example.com", "test.ru"]
}
```

### Настройки таргетинга по времени
```json
// time_targeting_schedule
{
    "Items": [
        {
            "Day": "MONDAY",
            "Hours": [9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
        }
    ]
}

// holidays_schedule
{
    "SuspendOnHolidays": "YES",
    "BidPercent": 100,
    "StartHour": 9,
    "EndHour": 18
}
```

### Стратегии
```json
// search_bidding_strategy
{
    "WbMaximumClicks": {
        "WeeklySpendLimit": 10000,
        "BidCeiling": 100
    }
}

// network_bidding_strategy
{
    "WbMaximumClicks": {
        "WeeklySpendLimit": 5000
    }
}
```

### Места показа
```json
// search_placement_types
{
    "SearchResults": "YES",
    "ProductGallery": "YES",
    "DynamicPlaces": "YES",
    "Maps": "YES",
    "SearchOrganizationList": "YES"
}

// network_placement_types
{
    "Network": "YES",
    "Maps": "YES"
}
```

### Дополнительные настройки
```json
// campaign_settings
{
    "Option": "ADD_METRICA_TAG",
    "Value": "YES"
}

// counter_ids
{
    "Items": [123456, 789012]
}

// priority_goals
{
    "Items": [
        {
            "GoalId": 123,
            "Value": 100,
            "IsMetrikaSourceOfValue": "YES"
        }
    ]
}

// package_bidding_strategy
{
    "StrategyId": 123,
    "StrategyFromCampaignId": 456
}

// package_bidding_platforms
{
    "SearchResult": "YES",
    "ProductGallery": "YES",
    "Maps": "YES",
    "SearchOrganizationList": "YES",
    "Network": "YES",
    "DynamicPlaces": "YES"
}

// negative_keyword_shared_set_ids
{
    "Items": [123, 456]
}
```

## Примечание
Для точного соответствия API Яндекс.Директ необходимы актуальные примеры JSON-структур из документации API. Пожалуйста, предоставьте примеры запросов от Яндекс.Директ для обновления этого файла. 