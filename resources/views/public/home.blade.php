@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-center">XO4U-SERVIS - Ваш AI-помощник в рекламе</h1>
    
    <!-- Основные возможности -->
    <div class="mb-12">
        <h2 class="text-3xl font-semibold mb-6">Основные возможности сервиса</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">Готовые рекламные связки</h3>
                <p class="text-gray-600">Шаблоны сайтов + шаблоны Яндекс.Директ для быстрого запуска рекламы</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">AI-помощник</h3>
                <p class="text-gray-600">Автоматизация управления рекламой и оптимизация сайтов</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">Интеграции</h3>
                <p class="text-gray-600">Яндекс.Директ, Яндекс.Метрика, ЮKassa и мессенджеры</p>
            </div>
        </div>
    </div>

    <!-- Путь клиента -->
    <div class="mb-12">
        <h2 class="text-3xl font-semibold mb-6">Как это работает</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <ol class="list-decimal list-inside space-y-4">
                <li class="text-lg">Регистрация аккаунта</li>
                <li class="text-lg">Выбор готовой рекламной связки</li>
                <li class="text-lg">Заполнение данных для шаблона и рекламы</li>
                <li class="text-lg">Автоматическое создание копии сайта</li>
                <li class="text-lg">Подключение Яндекс.Директ и Метрики</li>
                <li class="text-lg">Пополнение баланса и запуск рекламы</li>
            </ol>
        </div>
    </div>

    <!-- AI-помощник -->
    <div class="mb-12">
        <h2 class="text-3xl font-semibold mb-6">AI-помощник</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">Управление рекламой</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li>Анализ статистики</li>
                    <li>Оптимизация площадок</li>
                    <li>Управление ключевыми словами</li>
                    <li>Автоматические улучшения</li>
                </ul>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">Оптимизация сайта</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li>Предложения по улучшению</li>
                    <li>Автоматическое внедрение изменений</li>
                    <li>Анализ конверсии</li>
                    <li>Улучшение офферов</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Партнерская программа -->
    <div class="mb-12">
        <h2 class="text-3xl font-semibold mb-6">Партнерская программа</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Возможности партнера</h3>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Создание клиентских аккаунтов</li>
                        <li>Управление клиентами</li>
                        <li>Реферальная система</li>
                        <li>Отчеты по вознаграждениям</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Преимущества</h3>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Процент от трат клиентов</li>
                        <li>Доступ к статистике</li>
                        <li>Гибкая система комиссий</li>
                        <li>Поддержка 24/7</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Призыв к действию -->
    <div class="text-center mb-12">
        <a href="{{ route('register') }}" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg text-xl font-semibold hover:bg-blue-700 transition-colors">
            Начать работу сейчас
        </a>
    </div>
</div>
@endsection 