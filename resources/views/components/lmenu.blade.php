<div class="p-4 bg-white dark:bg-gray-800 shadow rounded mb-6">
    <nav class="space-y-2 text-gray-800 dark:text-gray-100">
        <!-- Общие пункты -->
        <a href="{{ route('projects.index') }}" class="block hover:underline">Мои проекты</a>
        <a href="{{ route('requests.index') }}" class="block hover:underline">Заявки</a>

        @can('admin-only')
            <!-- Админская секция -->
            <hr class="my-3 border-gray-600">

            <div class="font-bold mt-2">Admin</div>
            <a href="{{ route('admin.config') }}" class="block pl-4 hover:underline">Конфигурация</a>
            <a href="{{ route('admin.catalog') }}" class="block pl-4 hover:underline">Каталог</a>
            <a href="{{ route('admin.accounts') }}" class="block pl-4 hover:underline">Аккаунты</a>

            <div class="font-bold mt-2">Шаблоны</div>
            <a href="{{ route('admin.site-templates.index') }}" class="block pl-4 hover:underline">Шаблоны сайтов</a>

            <div class="font-bold mt-2">API</div>
            <a href="{{ route('admin.api.yandex_direct') }}" class="block pl-4 hover:underline">Яндекс Директ</a>
            <a href="{{ route('admin.api.yandex_metrika') }}" class="block pl-4 hover:underline">Яндекс Метрика</a>
            <a href="{{ route('admin.api.yookassa') }}" class="block pl-4 hover:underline">YooKassa</a>

            <div class="font-bold mt-2">Логи</div>
            <a href="{{ route('admin.logs.payments') }}" class="block pl-4 hover:underline">Оплаты</a>
            <a href="{{ route('admin.logs.errors') }}" class="block pl-4 hover:underline">Ошибки</a>
        @endcan
    </nav>
</div>

