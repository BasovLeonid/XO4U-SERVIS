<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'XO4U-SERVIS') }} - Административная панель</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Боковая навигация -->
        <div class="w-64 min-h-screen bg-gray-900">
            <div class="flex items-center justify-center h-16 bg-gray-800">
                <a href="{{ route('boss.dashboard') }}" class="text-white text-lg font-semibold">
                    {{ config('app.name', 'XO4U-SERVIS') }}
                </a>
            </div>
            <nav class="mt-5 px-2">
                <a href="{{ route('boss.dashboard') }}" class="group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Дашборд
                </a>

                <a href="{{ route('boss.settings.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Настройки
                </a>

                <a href="{{ route('boss.users.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Пользователи
                </a>

                <a href="{{ route('boss.site-templates.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                    </svg>
                    Шаблоны сайтов
                </a>

                <a href="{{ route('boss.direct-templates.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Шаблоны Яндекс.Директ
                </a>

                <a href="{{ route('boss.api.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    API
                </a>

                <a href="{{ route('boss.payments.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Платежи
                </a>

                <a href="{{ route('boss.logs.index') }}" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-800 focus:outline-none focus:bg-gray-800 transition ease-in-out duration-150">
                    <svg class="mr-4 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Логи
                </a>
            </nav>
        </div>

        <!-- Основной контент -->
        <div class="flex-1">
            <!-- Верхняя панель -->
            <div class="bg-white shadow">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <h1 class="text-2xl font-semibold text-gray-900">@yield('title', 'Панель управления')</h1>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-gray-700 hover:text-gray-900">
                                    Выйти
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Рабочая область -->
            <main class="flex-1">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded m-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html> 