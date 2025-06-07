# XO4U-SERVIS - Техническая документация

## Технический стек

### Backend
- PHP 8.2+
- Laravel 10.x
- MySQL 8.0+
- Redis (для кэширования)

### Frontend
- Bootstrap 5.x
- jQuery 3.x
- Alpine.js (для интерактивных компонентов)

## API Интеграции

### Яндекс.Директ API
- [Документация API](https://yandex.ru/dev/direct/doc/dg/concepts/about-docpage/)
- [Справочник по кампаниям](https://yandex.ru/dev/direct/doc/dg/concepts/campaigns-docpage/)
- [Справочник по стратегиям](https://yandex.ru/dev/direct/doc/dg/concepts/strategy-docpage/)

## Структура базы данных

### Основные таблицы
- `direct_templates` - шаблоны кампаний
- `direct_templates_campaigns` - кампании
- `direct_templates_campaign_sections` - разделы кампаний
- `direct_templates_campaign_logs` - логи кампаний
- `direct_templates_campaign_analytics` - аналитика кампаний
- `direct_templates_campaign_syncs` - синхронизация с Яндекс.Директ

## Конфигурация

### Основные настройки
```env
APP_NAME=XO4U-SERVIS
APP_ENV=local
APP_DEBUG=true
APP_URL=http://xo4u-servis.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xo4u_servis
DB_USERNAME=root
DB_PASSWORD=

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

YANDEX_DIRECT_CLIENT_ID=your_client_id
YANDEX_DIRECT_CLIENT_SECRET=your_client_secret
YANDEX_DIRECT_TOKEN=your_token
```

## Разработка

### Установка
1. Клонировать репозиторий
2. Установить зависимости: `composer install`
3. Скопировать `.env.example` в `.env`
4. Сгенерировать ключ: `php artisan key:generate`
5. Выполнить миграции: `php artisan migrate`
6. Запустить сервер: `php artisan serve`

### Команды
- `php artisan direct:sync` - синхронизация с Яндекс.Директ
- `php artisan direct:validate` - валидация кампаний
- `php artisan direct:export` - экспорт данных
- `php artisan direct:import` - импорт данных

## Тестирование

### Unit тесты
```bash
php artisan test
```

### Feature тесты
```bash
php artisan test --testsuite=Feature
```

## Деплой

### Требования к серверу
- PHP 8.2+
- MySQL 8.0+
- Redis
- Composer
- Node.js & NPM

### Процесс деплоя
1. Обновить код: `git pull`
2. Установить зависимости: `composer install --no-dev`
3. Очистить кэш: `php artisan cache:clear`
4. Обновить конфигурацию: `php artisan config:cache`
5. Выполнить миграции: `php artisan migrate --force`

## Мониторинг

### Логи
- Логи приложения: `storage/logs/laravel.log`
- Логи кампаний: `storage/logs/campaigns/`
- Логи синхронизации: `storage/logs/sync/`

### Метрики
- Время ответа API
- Количество запросов
- Использование памяти
- Ошибки синхронизации

## Безопасность

### Аутентификация
- Laravel Sanctum для API
- Session-based аутентификация для веб-интерфейса

### Авторизация
- Роли: admin, manager, user
- Политики для каждого ресурса
- Middleware для проверки прав

### Защита данных
- CSRF-токены для форм
- Валидация всех входных данных
- Шифрование чувствительных данных

## Оптимизация

### Кэширование
- Redis для кэширования
- Кэширование запросов к API
- Кэширование настроек

### Очереди
- Очереди для синхронизации
- Очереди для уведомлений
- Очереди для экспорта/импорта

## Дополнительные ресурсы

### Документация
- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev/docs)

### Полезные ссылки
- [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices)
- [PHP The Right Way](https://phptherightway.com/)
- [Laravel News](https://laravel-news.com/)
