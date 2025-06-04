<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Список шаблонов сайтов
            </h2>
            <a href="{{ route('admin.site-templates.create') }}" class="btn btn-primary">
                + Новый шаблон
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex space-x-6">
                <!-- Левое меню -->
                <div class="w-1/4">
                    <x-lmenu />
                </div>

                <!-- Основной контент -->
                <div class="w-3/4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="text-left px-4 py-2">ID</th>
                                    <th class="text-left px-4 py-2">Название</th>
                                    <th class="text-left px-4 py-2">Путь</th>
                                    <th class="text-left px-4 py-2">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siteTemplates as $template)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $template->id }}</td>
                                        <td class="px-4 py-2">{{ $template->name }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-500">{{ $template->template_path }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('admin.site-templates.edit', $template) }}" class="text-blue-500 hover:underline">Редактировать</a>
                                            <form method="POST" action="{{ route('admin.site-templates.destroy', $template) }}" class="inline-block ml-2" onsubmit="return confirm('Удалить шаблон?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Удалить</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $siteTemplates->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
