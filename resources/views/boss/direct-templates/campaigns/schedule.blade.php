@extends('boss.layouts.app')

@section('title', 'Расписание показов')

@section('content')
    <x-boss.direct-templates.container :title="'Расписание показов'">
        <x-slot:sidebar>
            <x-yandex-direct.campaigns.sidebar :campaign="$campaign" />
        </x-slot:sidebar>

        <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST" id="scheduleForm">
            @csrf
            @method('PUT')
            
            @include('yandex_direct.campaigns.schedule')

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Сохранить изменения
                </button>
                <a href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaign]) }}" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i>Отмена
                </a>
            </div>
        </form>

        @if(config('app.debug'))
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Отладочная информация</h5>
            </div>
            <div class="card-body">
                <h6>Текущие данные кампании:</h6>
                <pre class="bg-light p-3">{{ json_encode($campaign->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

                <h6 class="mt-3">Отправляемые данные:</h6>
                <pre class="bg-light p-3" id="formData"></pre>

                <h6 class="mt-3">Ответ сервера:</h6>
                <pre class="bg-light p-3" id="serverResponse"></pre>
            </div>
        </div>
        @endif
    </x-boss.direct-templates.container>
@endsection

@push('styles')
<style>
    pre {
        max-height: 300px;
        overflow-y: auto;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('scheduleForm');
        const formDataElement = document.getElementById('formData');
        const serverResponseElement = document.getElementById('serverResponse');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Собираем данные формы
            const formData = new FormData(form);
            const data = {};
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            
            // Показываем отправляемые данные
            formDataElement.textContent = JSON.stringify(data, null, 2);

            // Отправляем форму
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                serverResponseElement.textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                serverResponseElement.textContent = 'Ошибка: ' + error.message;
            });
        });
    });
</script>
@endpush 