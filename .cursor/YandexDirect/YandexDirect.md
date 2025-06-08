# Правила для AI: 
!!! Не создавай ссылки в структуру на не существующие файлы
!!! Не переноси файлы самостоятельно 



# Модуль Яндекс.Директ

## Структура модуля


app/
├── Http/
│   └── Controllers/
│       └── YandexDirect/          # Контроллеры модуля
│           ├── CampaignController.php     # Управление кампаниями
│           ├── AdGroupController.php      # Управление группами объявлений
│           ├── AdController.php           # Управление объявлениями
│           ├── SettingsController.php     # Управление настройками
│           └── ApiController.php          # Управление API интеграцией
├── Models/
│   └── YandexDirect/             # Модели модуля
│       ├── Campaign.php          # Модель рекламной кампании
│       ├── AdGroup.php           # Модель группы объявлений
│       └── Ad.php                # Модель объявления
├── View/
│   └── Components/
│       └── YandexDirect/        # Компоненты модуля
│           └── Campaigns/       # Компоненты для кампаний
│               ├── BasicSettings.php      # Базовые настройки
│               ├── AdvancedSettings.php   # Расширенные настройки
│               ├── AdditionalSettings.php # Дополнительные настройки
│               ├── Restrictions.php       # Ограничения
│               ├── Schedule.php           # Расписание
│               ├── Corrections.php        # Корректировки
│               └── Sidebar.php            # Боковая панель
└── Services/
    └── YandexDirect/            # Сервисы модуля
        └── YandexDirectAPI/     # API Яндекс.Директ
            ├── Direct/          # API Яндекс.Директ (v5 актуальная)
            │   ├── Api/         # API клиенты
            │   ├── DTO/         # Объекты передачи данных
            │   ├── Enums/       # Перечисления
            │   ├── Exceptions/  # Исключения
            │   └── Resources/   # Ресурсы API
            └── DirectV4/        # API Яндекс.Директ v4
                ├── Api/         # API клиенты
                ├── DTO/         # Объекты передачи данных
                └── Resources/   # Ресурсы API
resources/
└── views/
    └── yandex-direct/          # Представления модуля
        ├── interface_setting.blade.php    # Основной интерфейс настроек
        ├── partials/                     # Частичные представления
        │   ├── sidebar.blade.php         # Боковая панель
        │   └── styles.blade.php          # Стили интерфейса
        └── campaigns/                    # Представления для кампаний
            ├── basic_settings.blade.php
            ├── advanced_settings.blade.php
            ├── additional-settings.blade.php
            ├── restrictions.blade.php
            ├── schedule.blade.php
            └── corrections.blade.php
```


## Структура хранения Базы данных Яндекс директ: .cursor/YandexDirect/YandexDiretcBDmapping.md





Настройка компании/setting
Расписание показов /schedule

## Объяснение структуры

### 1. Стандартные директории Laravel
- `app/Http/Controllers/YandexDirect/` - контроллеры модуля
- `app/Models/YandexDirect/` - модели модуля
- `app/View/Components/YandexDirect/` - компоненты модуля
- `resources/views/yandex-direct/` - представления модуля

### 2. Основной интерфейс настроек
- `resources/views/yandex-direct/interface_setting.blade.php` - основной файл интерфейса, который объединяет все компоненты настроек кампании
  - Подключает все необходимые компоненты настроек
  - Обеспечивает единый интерфейс для редактирования кампании
  - Содержит общую форму для сохранения изменений
  - Включает адаптивную верстку
  - Подключает стили через `@include('yandex-direct.partials.styles')`

### 3. Стили интерфейса
- `resources/views/yandex-direct/partials/styles.blade.php` - основные стили интерфейса
  - Содержит все стили для основного интерфейса
  - Включает стили для сайдбара, форм, кнопок
  - Обеспечивает адаптивность на разных устройствах
  - Использует современные CSS-свойства и анимации
  - Подключается через `@include` для безопасности и удобства поддержки

### 4. Компоненты настроек
- `basic_settings.blade.php` - базовые настройки кампании
- `advanced_settings.blade.php` - расширенные настройки
- `additional-settings.blade.php` - дополнительные настройки
- `restrictions.blade.php` - ограничения
- `schedule.blade.php` - расписание показов
- `corrections.blade.php` - корректировки ставок

### 5. Использование интерфейса
```blade
@include('yandex-direct.interface_setting', [
    'campaign' => $campaign,
    'counters' => $counters,
    'goals' => $goals,
    'template' => $template
])
```

### 6. Преимущества новой структуры
1. **Единый интерфейс**
   - Все настройки доступны в одном месте
   - Удобная навигация через сайдбар
   - Единая форма для сохранения изменений

2. **Модульность**
   - Каждый компонент настроек независим
   - Легко добавлять новые компоненты
   - Простое обновление отдельных частей

3. **Адаптивность**
   - Корректное отображение на всех устройствах
   - Гибкая структура с использованием flexbox
   - Оптимизированная мобильная версия

4. **Поддержка**
   - Четкая структура файлов
   - Понятная организация компонентов
   - Легкое сопровождение кода

## Контроллеры

### CampaignController
- Управление рекламными кампаниями
- Основные методы:
  - `index()` - список кампаний
  - `create()` - создание кампании
  - `store()` - сохранение кампании
  - `edit()` - редактирование кампании
  - `update()` - обновление кампании
  - `destroy()` - удаление кампании

### AdGroupController
- Управление группами объявлений
- Основные методы:
  - `index()` - список групп
  - `create()` - создание группы
  - `store()` - сохранение группы
  - `edit()` - редактирование группы
  - `update()` - обновление группы
  - `destroy()` - удаление группы

### AdController
- Управление объявлениями
- Основные методы:
  - `index()` - список объявлений
  - `create()` - создание объявления
  - `store()` - сохранение объявления
  - `edit()` - редактирование объявления
  - `update()` - обновление объявления
  - `destroy()` - удаление объявления

### SettingsController
- Управление настройками модуля
- Основные методы:
  - `index()` - основные настройки
  - `api()` - настройки API
  - `update()` - обновление настроек
  - `sync()` - синхронизация с API

### ApiController
- Управление API интеграцией
- Основные методы:
  - `connect()` - подключение к API
  - `disconnect()` - отключение от API
  - `refresh()` - обновление токенов
  - `status()` - статус подключения

## Компоненты

### BasicSettings
- Отвечает за отображение базовых настроек кампании
- Использует представление: `campaigns/settings/basic.blade.php`
- Взаимодействует с моделью `Campaign`

### AdvancedSettings
- Управляет расширенными настройками
- Использует представление: `campaigns/settings/advanced.blade.php`
- Взаимодействует с:
  - Моделью `Campaign`
  - Счетчиками (`$counters`)
  - Целями (`$goals`)

### AdditionalSettings
- Управляет дополнительными настройками
- Использует представление: `campaigns/settings/additional.blade.php`
- Взаимодействует с моделью `Campaign`

### Restrictions
- Управляет ограничениями кампании
- Использует представление: `campaigns/settings/restrictions.blade.php`
- Взаимодействует с моделью `Campaign`

### Schedule
- Управляет расписанием кампании
- Использует представление: `campaigns/settings/schedule.blade.php`
- Взаимодействует с моделью `Campaign`

### Corrections
- Управляет корректировками кампании
- Использует представление: `campaigns/settings/corrections.blade.php`
- Взаимодействует с моделью `Campaign`

### Sidebar
- Обеспечивает навигацию по разделам
- Использует представление: `campaigns/partials/sidebar.blade.php`
- Взаимодействует с:
  - Моделью `Campaign`
  - Активным разделом (`$activeSection`)

## Маршруты

```php
// routes/web.php
Route::prefix('yandex-direct')->group(function () {
    // Кампании
    Route::resource('campaigns', CampaignController::class);
    
    // Группы объявлений
    Route::resource('campaigns.ad-groups', AdGroupController::class);
    
    // Объявления
    Route::resource('campaigns.ad-groups.ads', AdController::class);
    
    // Настройки
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/api', [SettingsController::class, 'api'])->name('settings.api');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('settings/sync', [SettingsController::class, 'sync'])->name('settings.sync');
    
    // API
    Route::prefix('api')->group(function () {
        Route::post('connect', [ApiController::class, 'connect'])->name('api.connect');
        Route::post('disconnect', [ApiController::class, 'disconnect'])->name('api.disconnect');
        Route::post('refresh', [ApiController::class, 'refresh'])->name('api.refresh');
        Route::get('status', [ApiController::class, 'status'])->name('api.status');
    });
});
```

## Использование компонентов

```blade
<x-yandex-direct.campaigns.sidebar :campaign="$campaign" :active-section="'basic'" />

<div class="content">
    <x-yandex-direct.campaigns.basic-settings :campaign="$campaign" />
    <x-yandex-direct.campaigns.advanced-settings 
        :campaign="$campaign" 
        :counters="$counters" 
        :goals="$goals" 
    />
    <x-yandex-direct.campaigns.additional-settings :campaign="$campaign" />
    <x-yandex-direct.campaigns.restrictions :campaign="$campaign" />
    <x-yandex-direct.campaigns.schedule :campaign="$campaign" />
    <x-yandex-direct.campaigns.corrections :campaign="$campaign" />
</div>
```
