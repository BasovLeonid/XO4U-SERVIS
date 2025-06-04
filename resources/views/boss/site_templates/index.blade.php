@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Шаблоны сайтов</h3>
                    <div class="card-tools">
                        <a href="{{ route('boss.site-templates.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Создать шаблон
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        @forelse($templates as $template)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="preview-container">
                                        @if($template->preview_image)
                                            <img src="{{ Storage::url($template->preview_image) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $template->name }}">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $template->name }}</h5>
                                        <p class="card-text text-muted">{{ $template->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge badge-{{ $template->status === 'active' ? 'success' : ($template->status === 'draft' ? 'warning' : 'secondary') }}">
                                                {{ $template->status === 'active' ? 'Активный' : ($template->status === 'draft' ? 'Черновик' : 'Архивный') }}
                                            </span>
                                            <small class="text-muted">Код: {{ $template->template_code }}</small>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-group w-100">
                                            <a href="{{ route('boss.site-templates.show', $template) }}" class="btn btn-info">
                                                <i class="fas fa-eye"></i> Просмотр
                                            </a>
                                            <a href="{{ route('boss.site-templates.edit', $template) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i> Редактировать
                                            </a>
                                            <a href="{{ route('boss.site-templates.preview', $template) }}" 
                                               class="btn btn-info btn-sm" 
                                               target="_blank"
                                               title="Предпросмотр шаблона">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('boss.site-templates.destroy', $template) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Шаблоны не найдены
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $templates->links() }}
                    </div>
                </div>
            </div>

            <!-- Информационный блок о структуре шаблонов -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Структура шаблонов</h3>
                </div>
                <div class="card-body">
                    <h4>Расположение файлов</h4>
                    <p>Все файлы шаблонов хранятся в директории <code>storage/app/store/site_templates/</code> в следующей структуре:</p>
                    
                    <pre class="bg-light p-3 rounded">
storage/app/store/site_templates/
├── {template_code}/              # Директория шаблона
│   ├── template.blade.php       # Основной файл шаблона
│   ├── config.json             # Конфигурация шаблона
│   ├── assets/                 # Статические файлы
│   │   ├── css/               # Стили
│   │   │   └── style.css
│   │   ├── js/                # Скрипты
│   │   │   └── script.js
│   │   └── images/            # Изображения
│   └── blocks/                # Блоки шаблона
│       ├── header.blade.php
│       ├── main_banner.blade.php
│       ├── about.blade.php
│       ├── services.blade.php
│       └── contacts.blade.php</pre>

                    <h4 class="mt-4">Как это работает</h4>
                    <ol>
                        <li><strong>Создание шаблона:</strong>
                            <ul>
                                <li>Загружается ZIP-архив с файлами шаблона</li>
                                <li>Архив распаковывается в директорию <code>storage/app/store/site_templates/{template_code}/</code></li>
                                <li>Создается запись в базе данных с информацией о шаблоне</li>
                            </ul>
                        </li>
                        <li><strong>Предпросмотр шаблона:</strong>
                            <ul>
                                <li>Система читает основной файл шаблона (<code>template.blade.php</code>)</li>
                                <li>Находит все включения блоков (<code>@@include</code>)</li>
                                <li>Читает содержимое каждого блока из директории <code>blocks/</code></li>
                                <li>Объединяет все в один файл и компилирует через Blade</li>
                                <li>Подключает стили и скрипты из директории <code>assets/</code></li>
                            </ul>
                        </li>
                        <li><strong>Переменные шаблона:</strong>
                            <ul>
                                <li>Определяются в <code>config.json</code></li>
                                <li>Хранятся в базе данных</li>
                                <li>Передаются в шаблон при предпросмотре</li>
                            </ul>
                        </li>
                    </ol>

                    <h4 class="mt-4">Требования к шаблону</h4>
                    <ul>
                        <li>Основной файл должен называться <code>template.blade.php</code></li>
                        <li>Блоки должны находиться в директории <code>blocks/</code></li>
                        <li>Статические файлы должны быть в директории <code>assets/</code></li>
                        <li>Конфигурация должна быть в файле <code>config.json</code></li>
                        <li>Все пути в шаблоне должны быть относительными</li>
                    </ul>

                    <h4 class="mt-4">Документация для разработчиков</h4>
                    
                    <div class="card">
                        <div class="card-header">
                            <h5>1. Структура шаблона</h5>
                        </div>
                        <div class="card-body">
                            <p>Каждый шаблон должен содержать следующие файлы:</p>
                            <pre class="bg-light p-3 rounded">
template.blade.php      # Основной файл шаблона
config.json            # Конфигурация и переменные
blocks/                # Директория с блоками
    header.blade.php
    footer.blade.php
    ...
assets/               # Статические файлы
    css/
    js/
    images/</pre>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>2. Конфигурация (config.json)</h5>
                        </div>
                        <div class="card-body">
                            <p>Файл <code>config.json</code> определяет переменные шаблона:</p>
                            <pre class="bg-light p-3 rounded">
{
    "name": "Название шаблона",
    "description": "Описание шаблона",
    "variables": {
        "company_name": {
            "type": "string",
            "label": "Название компании",
            "default_value": "Моя компания",
            "required": true
        },
        "phone": {
            "type": "string",
            "label": "Телефон",
            "default_value": "+7 (999) 123-45-67",
            "required": true
        },
        "email": {
            "type": "string",
            "label": "Email",
            "default_value": "info@example.com",
            "required": true
        },
        "address": {
            "type": "text",
            "label": "Адрес",
            "default_value": "г. Москва, ул. Примерная, д. 1",
            "required": false
        }
    }
}</pre>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>3. Основной файл шаблона (template.blade.php)</h5>
                        </div>
                        <div class="card-body">
                            <p>Пример основного файла шаблона:</p>
                            <pre class="bg-light p-3 rounded">
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@isset($company_name){{ $company_name }}@else Моя компания @endisset</title>
    
    <!-- Подключение стилей -->
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Подключение блоков -->
    @@include('site_templates.' . $template->template_code . '.blocks.header')
    
    <main>
        <!-- Использование переменных -->
        <h1>@isset($company_name){{ $company_name }}@else Моя компания @endisset</h1>
        <p>Телефон: @isset($phone){{ $phone }}@else Не указан @endisset</p>
        <p>Email: @isset($email){{ $email }}@else Не указан @endisset</p>
        
        <!-- Условные блоки -->
        @isset($address)
            <p>Адрес: {{ $address }}</p>
        @endisset
    </main>
    
    @@include('site_templates.' . $template->template_code . '.blocks.footer')
    
    <!-- Подключение скриптов -->
    <script src="{{ asset('js/template.js') }}"></script>
</body>
</html></pre>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>4. Блоки шаблона</h5>
                        </div>
                        <div class="card-body">
                            <p>Пример блока header.blade.php:</p>
                            <pre class="bg-light p-3 rounded">
<header class="site-header">
    <div class="container">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="@isset($company_name){{ $company_name }}@else Моя компания @endisset">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="#about">О нас</a></li>
                <li><a href="#services">Услуги</a></li>
                <li><a href="#contacts">Контакты</a></li>
            </ul>
        </nav>
    </div>
</header></pre>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>5. Работа с переменными</h5>
                        </div>
                        <div class="card-body">
                            <p>Доступ к переменным в шаблоне:</p>
                            <pre class="bg-light p-3 rounded">
<!-- Простое использование с проверкой -->
@isset($company_name)
    {{ $company_name }}
@else
    Моя компания
@endisset

<!-- С значением по умолчанию -->
@isset($phone)
    {{ $phone }}
@else
    Не указан
@endisset

<!-- Условное отображение блока -->
@isset($address)
    <p>Адрес: {{ $address }}</p>
@endisset

<!-- Циклы по массивам с проверкой -->
@isset($services)
    @foreach($services as $service)
        <div class="service">
            <h3>@isset($service['title']){{ $service['title'] }}@else Без названия @endisset</h3>
            <p>@isset($service['description']){{ $service['description'] }}@else Нет описания @endisset</p>
        </div>
    @endforeach
@endisset

<!-- Проверка нескольких условий -->
@isset($company_name, $phone, $email)
    <div class="contact-info">
        <p>Компания: {{ $company_name }}</p>
        <p>Телефон: {{ $phone }}</p>
        <p>Email: {{ $email }}</p>
    </div>
@endisset</pre>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>6. Подключение ресурсов</h5>
                        </div>
                        <div class="card-body">
                            <p>Правильное подключение CSS и JavaScript:</p>
                            <pre class="bg-light p-3 rounded">
<!-- CSS файлы -->
<link href="{{ asset('css/template.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

<!-- JavaScript файлы -->
<script src="{{ asset('js/template.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}" defer></script>

<!-- Изображения с проверкой -->
@isset($logo)
    <img src="{{ asset('images/' . $logo) }}" alt="@isset($company_name){{ $company_name }}@else Логотип @endisset">
@else
    <img src="{{ asset('images/default-logo.png') }}" alt="Логотип">
@endisset

@isset($banner)
    <img src="{{ asset('images/' . $banner) }}" alt="@isset($banner_alt){{ $banner_alt }}@else Баннер @endisset">
@else
    <img src="{{ asset('images/default-banner.jpg') }}" alt="Баннер">
@endisset</pre>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>7. Рекомендации по разработке</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Используйте семантическую верстку (header, main, footer, section, article)</li>
                                <li>Обеспечьте адаптивность для всех устройств</li>
                                <li>Оптимизируйте изображения перед загрузкой</li>
                                <li>Используйте относительные пути для всех ресурсов</li>
                                <li>Добавляйте комментарии к сложным блокам кода</li>
                                <li>Проверяйте валидность HTML и CSS</li>
                                <li>Тестируйте шаблон на разных браузерах</li>
                                <li>Используйте префиксы для CSS-свойств</li>
                                <li>Минифицируйте CSS и JavaScript файлы</li>
                                <li>Добавляйте мета-теги для SEO</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>8. Проверка перед загрузкой</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Все переменные определены в config.json</li>
                                <li>Все блоки находятся в директории blocks/</li>
                                <li>Все ресурсы находятся в директории assets/</li>
                                <li>Все пути относительные</li>
                                <li>Шаблон адаптивный</li>
                                <li>Код оптимизирован</li>
                                <li>Изображения сжаты</li>
                                <li>Файлы минифицированы</li>
                                <li>Нет ошибок в консоли</li>
                                <li>Работает на всех браузерах</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .preview-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        background-color: #f8f9fa;
        overflow: hidden;
    }
    .preview-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 0.3s ease;
    }
    .preview-container:hover img {
        transform: scale(1.05);
    }
    .preview-container .bg-light {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    pre {
        margin: 1rem 0;
        font-size: 0.9rem;
        white-space: pre-wrap;
        word-wrap: break-word;
    }
    .card {
        margin-bottom: 1rem;
    }
    .card-header h5 {
        margin: 0;
        font-size: 1.1rem;
    }
</style>
@endpush
@endsection 