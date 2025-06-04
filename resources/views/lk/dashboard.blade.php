@extends('layouts.lk')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Личный кабинет</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Статистика -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Проекты</h2>
            <p class="text-3xl font-bold text-blue-600">0</p>
            <p class="text-gray-600">Активных проектов</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Заявки</h2>
            <p class="text-3xl font-bold text-green-600">0</p>
            <p class="text-gray-600">Новых заявок</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Баланс</h2>
            <p class="text-3xl font-bold text-purple-600">0 ₽</p>
            <p class="text-gray-600">Текущий баланс</p>
        </div>
    </div>
    
    <!-- Последние действия -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold mb-4">Последние действия</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600">У вас пока нет активных действий</p>
        </div>
    </div>
</div>
@endsection 