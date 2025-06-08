/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oauth_token` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `user_id` bigint unsigned NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `api_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `api_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect_uri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci,
  `refresh_token` text COLLATE utf8mb4_unicode_ci,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_settings_service_unique` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_bid_adjustments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_bid_adjustments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `yandex_ad_group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор группы объявлений',
  `mobile_adjustment` json DEFAULT NULL COMMENT '{\r\n                    "BidModifier": 100,          // Значение коэффициента к ставке (0-1300)\r\n                    "OperatingSystemType": null  // Тип операционной системы\r\n                }',
  `tablet_adjustment` json DEFAULT NULL COMMENT '{\r\n                    "BidModifier": 100,          // Значение коэффициента к ставке (0-1300)\r\n                    "OperatingSystemType": null  // Тип операционной системы\r\n                }',
  `desktop_adjustment` json DEFAULT NULL COMMENT '{\r\n                    "BidModifier": 100  // Значение коэффициента к ставке (0-1300)\r\n                }',
  `desktop_only_adjustment` json DEFAULT NULL COMMENT '{\r\n                    "BidModifier": 100  // Значение коэффициента к ставке (0-1300)\r\n                }',
  `demographics_adjustments` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "Gender": null,       // Пол пользователя (GENDER_MALE/GENDER_FEMALE)\r\n                            "Age": null,          // Возрастная группа\r\n                            "BidModifier": 100    // Значение коэффициента к ставке (0-1300)\r\n                        }\r\n                    ]\r\n                }',
  `retargeting_adjustments` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "RetargetingConditionId": 0,  // Идентификатор условия ретаргетинга\r\n                            "BidModifier": 100            // Значение коэффициента к ставке (0-1300)\r\n                        }\r\n                    ]\r\n                }',
  `regional_adjustments` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "RegionId": 0,        // Идентификатор региона\r\n                            "BidModifier": 100    // Значение коэффициента к ставке (10-1300)\r\n                        }\r\n                    ]\r\n                }',
  `video_adjustment` json DEFAULT NULL COMMENT '{\r\n                    "BidModifier": 100  // Значение коэффициента к ставке (50-1300)\r\n                }',
  `smart_ad_adjustment` json DEFAULT NULL COMMENT '{\r\n                    "BidModifier": 100  // Значение коэффициента к ставке (20-1300)\r\n                }',
  `serp_layout_adjustments` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "SerpLayout": null,   // Блок показа (ALONE/SUGGEST)\r\n                            "BidModifier": 100    // Значение коэффициента к ставке (1-1300)\r\n                        }\r\n                    ]\r\n                }',
  `income_grade_adjustments` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "Grade": null,        // Уровень платежеспособности\r\n                            "BidModifier": 100    // Значение коэффициента к ставке (1-1300)\r\n                        }\r\n                    ]\r\n                }',
  `ad_group_adjustment` json DEFAULT NULL COMMENT '{\r\n                    "BidModifier": 100  // Значение коэффициента к ставке (1-1300)\r\n                }',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_bid_adjustments_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_bid_adjustments_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaign_bid_adjustments_yandex_ad_group_id_index` (`yandex_ad_group_id`),
  CONSTRAINT `direct_campaign_bid_adjustments_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_exclusions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_exclusions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `blocked_ips` json DEFAULT NULL COMMENT '{\r\n                    "Items": []  // Массив IP-адресов, которым не нужно показывать объявления\r\n                }',
  `excluded_sites` json DEFAULT NULL COMMENT '{\r\n                    "Items": []  // Массив мест показа, где не нужно показывать объявления\r\n                }',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_exclusions_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_exclusions_yandex_campaign_id_index` (`yandex_campaign_id`),
  CONSTRAINT `direct_campaign_exclusions_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_metrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_metrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `counter_ids` json DEFAULT NULL COMMENT '{\r\n                    "Items": [0]  // Массив идентификаторов счетчиков Яндекс Метрики\r\n                }',
  `primary_counter_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор основного счетчика Яндекс Метрики',
  `priority_goals` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "GoalId": 0,      // Идентификатор цели Яндекс Метрики\r\n                            "Value": 0,       // Ценность конверсии в валюте рекламодателя, умноженная на 1 000 000\r\n                            "IsMetrikaSourceOfValue": "YES"  // Флаг использования значения из Метрики\r\n                        }\r\n                    ]\r\n                }',
  `primary_goal_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор основной цели Яндекс Метрики',
  `primary_goal_value` decimal(15,6) DEFAULT NULL COMMENT 'Ценность основной цели в валюте рекламодателя, умноженная на 1 000 000',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_metrics_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_metrics_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaign_metrics_primary_counter_id_index` (`primary_counter_id`),
  KEY `direct_campaign_metrics_primary_goal_id_index` (`primary_goal_id`),
  KEY `direct_campaign_metrics_primary_goal_value_index` (`primary_goal_value`),
  CONSTRAINT `direct_campaign_metrics_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_negative_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_negative_keywords` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `yandex_ad_group_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор группы объявлений',
  `negative_keywords` json DEFAULT NULL COMMENT '{\r\n                    "Items": []  // Массив минус-фраз, общих для всех ключевых фраз кампании\r\n                }',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_negative_keywords_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_negative_keywords_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaign_negative_keywords_yandex_ad_group_id_index` (`yandex_ad_group_id`),
  CONSTRAINT `direct_campaign_negative_keywords_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_network_strategies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_network_strategies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `network_strategy_type` enum('WB_MAXIMUM_CLICKS','AVERAGE_CPC','WB_MAXIMUM_CONVERSION_RATE','AVERAGE_CPA','PAY_FOR_CONVERSION') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Стратегия показа в сетях',
  `network_wb_maximum_clicks_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `network_wb_maximum_clicks_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `network_average_cpc_average_cpc` decimal(15,6) DEFAULT NULL COMMENT 'Средняя цена клика в валюте рекламодателя, умноженная на 1 000 000',
  `network_average_cpc_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `network_wb_maximum_conversion_rate_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `network_wb_maximum_conversion_rate_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `network_wb_maximum_conversion_rate_goal_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор цели Яндекс Метрики',
  `network_average_cpa_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `network_average_cpa_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `network_average_cpa_exploration_budget` json DEFAULT NULL COMMENT '{\r\n                    "MinimumExplorationBudget": 0,\r\n                    "IsMinimumExplorationBudgetCustom": "YES"\r\n                }',
  `network_average_cpa_goal_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор цели Яндекс Метрики',
  `network_average_cpa_average_cpa` decimal(15,6) DEFAULT NULL COMMENT 'Средняя цена достижения цели в валюте рекламодателя, умноженная на 1 000 000',
  `network_average_cpa_multiple_goals_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `network_average_cpa_multiple_goals_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `network_average_cpa_multiple_goals_exploration_budget` json DEFAULT NULL COMMENT '{\r\n                    "MinimumExplorationBudget": 0,\r\n                    "IsMinimumExplorationBudgetCustom": "YES"\r\n                }',
  `network_average_cpa_multiple_goals_priority_goals` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "GoalId": 0,\r\n                            "Value": 0,\r\n                            "IsMetrikaSourceOfValue": "YES"\r\n                        }\r\n                    ]\r\n                }',
  `network_pay_for_conversion_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `network_pay_for_conversion_cpa` decimal(15,6) DEFAULT NULL COMMENT 'Цена достижения цели в валюте рекламодателя, умноженная на 1 000 000',
  `network_pay_for_conversion_goal_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор цели Яндекс Метрики',
  `network_pay_for_conversion_multiple_goals_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `network_pay_for_conversion_multiple_goals_priority_goals` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "GoalId": 0,\r\n                            "Value": 0,\r\n                            "IsMetrikaSourceOfValue": "YES"\r\n                        }\r\n                    ]\r\n                }',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_network_strategies_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_network_strategies_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaign_network_strategies_network_strategy_type_index` (`network_strategy_type`),
  CONSTRAINT `direct_campaign_network_strategies_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `start_date` date NOT NULL COMMENT 'Дата начала показа кампании',
  `end_date` date DEFAULT NULL COMMENT 'Дата окончания показа кампании',
  `time_zone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Europe/Moscow' COMMENT 'Часовой пояс в месте нахождения рекламодателя',
  `time_targeting_type` enum('custom','budni','set1','set2','set3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'budni' COMMENT 'Тип временного таргетинга',
  `time_targeting_custom` json DEFAULT NULL COMMENT '{\r\n                    "Schedule": [\r\n                        "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"\r\n                    ]\r\n                }',
  `time_targeting_budni` json DEFAULT NULL COMMENT '{\r\n                    "Schedule": [\r\n                        "1,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",\r\n                        "2,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",\r\n                        "3,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",\r\n                        "4,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",\r\n                        "5,0,0,0,0,0,0,0,0,100,100,100,100,100,100,100,100,100,100,100,0,0,0,0,0",\r\n                        "6,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0",\r\n                        "7,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0"\r\n                    ]\r\n                }',
  `time_targeting_set1` json DEFAULT NULL COMMENT '{\r\n                    "Schedule": [\r\n                        "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"\r\n                    ]\r\n                }',
  `time_targeting_set2` json DEFAULT NULL COMMENT '{\r\n                    "Schedule": [\r\n                        "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"\r\n                    ]\r\n                }',
  `time_targeting_set3` json DEFAULT NULL COMMENT '{\r\n                    "Schedule": [\r\n                        "1,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "2,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "3,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "4,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "5,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "6,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100",\r\n                        "7,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100,100"\r\n                    ]\r\n                }',
  `consider_working_weekends` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'YES' COMMENT 'Менять ли расписание показов при переносе рабочего дня на субботу или воскресенье',
  `holidays_schedule` json DEFAULT NULL COMMENT '{\r\n                    "SuspendOnHolidays": "YES",  // Останавливать ли объявления в праздничные нерабочие дни\r\n                    "BidPercent": 100,           // Коэффициент к ставке при показе в праздничные нерабочие дни (10-200, кратно 10)\r\n                    "StartHour": 0,              // Время начала показов в праздничные нерабочие дни (0-23)\r\n                    "EndHour": 24                // Время окончания показов в праздничные нерабочие дни (1-24)\r\n                }',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_schedules_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_schedules_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaign_schedules_time_targeting_type_index` (`time_targeting_type`),
  KEY `direct_campaign_schedules_start_date_end_date_index` (`start_date`,`end_date`),
  CONSTRAINT `direct_campaign_schedules_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_search_strategies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_search_strategies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `search_strategy_type` enum('HIGHEST_POSITION','WB_MAXIMUM_CLICKS','AVERAGE_CPC','WB_MAXIMUM_CONVERSION_RATE','AVERAGE_CPA','PAY_FOR_CONVERSION') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Стратегия показа на поиске',
  `search_wb_maximum_clicks_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `search_wb_maximum_clicks_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `search_average_cpc_average_cpc` decimal(15,6) DEFAULT NULL COMMENT 'Средняя цена клика в валюте рекламодателя, умноженная на 1 000 000',
  `search_average_cpc_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `search_wb_maximum_conversion_rate_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `search_wb_maximum_conversion_rate_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `search_wb_maximum_conversion_rate_goal_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор цели Яндекс Метрики',
  `search_average_cpa_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `search_average_cpa_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `search_average_cpa_exploration_budget` json DEFAULT NULL COMMENT '{\r\n                    "MinimumExplorationBudget": 0,\r\n                    "IsMinimumExplorationBudgetCustom": "YES"\r\n                }',
  `search_average_cpa_goal_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор цели Яндекс Метрики',
  `search_average_cpa_average_cpa` decimal(15,6) DEFAULT NULL COMMENT 'Средняя цена достижения цели в валюте рекламодателя, умноженная на 1 000 000',
  `search_average_cpa_multiple_goals_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `search_average_cpa_multiple_goals_bid_ceiling` decimal(15,6) DEFAULT NULL COMMENT 'Максимальная ставка в валюте рекламодателя, умноженная на 1 000 000',
  `search_average_cpa_multiple_goals_exploration_budget` json DEFAULT NULL COMMENT '{\r\n                    "MinimumExplorationBudget": 0,\r\n                    "IsMinimumExplorationBudgetCustom": "YES"\r\n                }',
  `search_average_cpa_multiple_goals_priority_goals` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "GoalId": 0,\r\n                            "Value": 0,\r\n                            "IsMetrikaSourceOfValue": "YES"\r\n                        }\r\n                    ]\r\n                }',
  `search_pay_for_conversion_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `search_pay_for_conversion_cpa` decimal(15,6) DEFAULT NULL COMMENT 'Цена достижения цели в валюте рекламодателя, умноженная на 1 000 000',
  `search_pay_for_conversion_goal_id` bigint unsigned DEFAULT NULL COMMENT 'Идентификатор цели Яндекс Метрики',
  `search_pay_for_conversion_multiple_goals_weekly_spend_limit` decimal(15,6) DEFAULT NULL COMMENT 'Недельный бюджет в валюте рекламодателя, умноженный на 1 000 000',
  `search_pay_for_conversion_multiple_goals_priority_goals` json DEFAULT NULL COMMENT '{\r\n                    "Items": [\r\n                        {\r\n                            "GoalId": 0,\r\n                            "Value": 0,\r\n                            "IsMetrikaSourceOfValue": "YES"\r\n                        }\r\n                    ]\r\n                }',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_search_strategies_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_search_strategies_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaign_search_strategies_search_strategy_type_index` (`search_strategy_type`),
  CONSTRAINT `direct_campaign_search_strategies_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaign_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaign_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `direct_campaign_id` bigint unsigned NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Идентификатор кампании',
  `tracking_params` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Параметры URL для шаблонов',
  `attribution_model` enum('FC','LC','LSC','LYDC','FCCD','LSCCD','LYDCCD','AUTO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AUTO' COMMENT 'Модель атрибуции, используемая для оптимизации конверсий',
  `add_metrica_tag` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Автоматически добавлять в ссылку объявления метку yclid с уникальным номером клика',
  `add_openstat_tag` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'При переходе на сайт рекламодателя добавлять к URL метку в формате OpenStat',
  `add_to_favorites` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Добавить кампанию в самые важные для применения фильтра в веб-интерфейсе',
  `campaign_exact_phrase_matching_enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Включает отбор фразы по точности соответствия внутри кампании',
  `enable_area_of_interest_targeting` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Включить Расширенный географический таргетинг',
  `enable_company_info` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'При показе на Яндекс Картах добавлять в объявление информацию об организации из Яндекс Справочника',
  `enable_extended_ad_title` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Включить подстановку части текста объявления в заголовок',
  `enable_site_monitoring` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Останавливать показы при недоступности сайта рекламодателя',
  `exclude_paused_competing_ads` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Рассчитывать прогнозируемые ставки без учета ставок в объявлениях конкурентов, остановленных в соответствии с временным таргетингом',
  `maintain_network_cpc` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Удерживать среднюю цену клика в сетях ниже средней цены на поиске',
  `require_servicing` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Перевести кампанию на обслуживание персональным менеджером',
  `shared_account_enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Подключен общий счет',
  `alternative_texts_enabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Оптимизировать текст объявлений под запрос',
  `setting_param` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaign_settings_direct_campaign_id_index` (`direct_campaign_id`),
  KEY `direct_campaign_settings_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaign_settings_attribution_model_index` (`attribution_model`),
  CONSTRAINT `direct_campaign_settings_direct_campaign_id_foreign` FOREIGN KEY (`direct_campaign_id`) REFERENCES `direct_campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_campaigns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `account_id` bigint unsigned DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` json DEFAULT NULL,
  `user_param` json DEFAULT NULL,
  `template_param` json DEFAULT NULL,
  `setting_param` json DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yandex_campaign_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `daily_budget_amount` decimal(15,6) NOT NULL COMMENT 'Дневной бюджет кампании в валюте рекламодателя, умноженный на 1 000 000',
  `daily_budget_mode` enum('STANDARD','DISTRIBUTED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'STANDARD' COMMENT 'Режим показа объявлений: STANDARD — стандартный, DISTRIBUTED — распределенный',
  `search_result` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'YES' COMMENT 'Поисковая выдача',
  `dynamic_places` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO' COMMENT 'Динамические места на поиске',
  `product_gallery` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'YES' COMMENT 'Товарная галерея',
  `search_organization_list` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO' COMMENT 'Список организаций в результатах поиска',
  `network` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'YES' COMMENT 'Рекламная сеть Яндекса',
  `maps` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO' COMMENT 'Яндекс Карты',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `direct_campaigns_yandex_campaign_id_index` (`yandex_campaign_id`),
  KEY `direct_campaigns_user_id_index` (`user_id`),
  KEY `direct_campaigns_account_id_index` (`account_id`),
  KEY `direct_campaigns_template_id_index` (`template_id`),
  KEY `direct_campaigns_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `direct_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direct_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Название шаблона',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Описание шаблона',
  `types` json NOT NULL COMMENT 'Типы шаблона (search, network, maps)',
  `strategy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Стратегия шаблона',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Изображение шаблона',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `site_template_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_template_blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_template_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_template_blocks_site_template_id_block_code_unique` (`site_template_id`,`block_code`),
  CONSTRAINT `site_template_blocks_site_template_id_foreign` FOREIGN KEY (`site_template_id`) REFERENCES `site_templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `site_template_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_template_variables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_template_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variable_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_value` text COLLATE utf8mb4_unicode_ci,
  `validation_rules` json DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_template_variables_site_template_id_variable_code_unique` (`site_template_id`,`variable_code`),
  CONSTRAINT `site_template_variables_site_template_id_foreign` FOREIGN KEY (`site_template_id`) REFERENCES `site_templates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `site_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `preview_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','draft','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_templates_template_code_unique` (`template_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_auth_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_spent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `repeat_purchases` int NOT NULL DEFAULT '0',
  `payment_rating` decimal(5,2) NOT NULL DEFAULT '0.00',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2024_03_01_000002_add_additional_fields_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2024_03_02_000000_create_accounts_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2024_03_02_000000_create_site_templates_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2025_05_30_181301_add_role_to_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2024_03_19_create_api_settings_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2024_03_21_000001_create_direct_templates_campaigns_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2024_03_21_000002_create_direct_templates_ad_groups_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2024_03_21_000003_create_direct_templates_ads_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2024_03_21_000004_create_direct_templates_keywords_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2024_03_21_000005_create_direct_templates_bid_modifiers_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2024_03_21_000006_create_direct_templates_ad_extensions_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2024_03_21_000007_create_direct_templates_audiences_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16,'2024_03_21_000008_create_direct_templates_feeds_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2024_03_22_000001_add_fields_to_direct_templates_campaigns_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2024_03_22_000002_add_template_image_to_direct_templates_campaigns_table',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2025_06_03_123643_create_direct_templates_table',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2024_03_21_000001_create_direct_templates_table',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2024_03_21_000002_create_direct_templates_campaigns_table',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2024_03_19_000000_update_direct_templates_campaigns_table',8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2024_03_19_000001_add_additional_fields_to_direct_templates_campaigns_table',9);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2024_03_23_000000_make_start_date_nullable_in_campaigns_table',10);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2024_03_19_000001_create_direct_templates_campaigns_table',11);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2024_03_19_000002_add_status_and_url_to_direct_templates_campaigns_table',12);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2024_03_19_000003_add_advanced_settings_to_direct_templates_campaigns_table',13);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2024_03_19_000004_add_soft_deletes_to_direct_templates_campaigns_table',14);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2024_03_22_000001_make_campaign_fields_optional',15);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2024_03_22_000002_fix_campaign_fields',16);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2024_03_21_000001_create_direct_campaigns_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2024_03_21_000002_create_direct_campaign_search_strategies_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2024_03_21_000003_create_direct_campaign_network_strategies_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2024_03_21_000004_create_direct_campaign_metrics_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2024_03_21_000005_create_direct_campaign_schedules_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2024_03_21_000006_create_direct_campaign_bid_adjustments_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'2024_03_21_000007_create_direct_campaign_negative_keywords_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'2024_03_21_000008_create_direct_campaign_exclusions_table',17);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2024_03_21_000009_create_direct_campaign_settings_table',17);
