@extends('boss.layouts.app')

@section('title', 'Настройки кампании')

@section('content')
<x-boss.direct-templates.container title="Настройки кампании '{{ $campaign->name }}'">
    <x-slot:sidebar>
        <x-yandex-direct.campaigns.sidebar :campaign="$campaign" />
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST" id="settingsForm">
                @csrf
                @method('PUT')

                <x-yandex-direct.campaigns.basic-settings :campaign="$campaign" />
                
                <x-yandex-direct.campaigns.advanced-settings 
                    :campaign="$campaign"
                    :counters="$counters"
                    :goals="$goals" />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <a href="{{ route('boss.direct-templates.campaigns.show', [$template, $campaign]) }}" class="btn btn-secondary">Отмена</a>
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
        </div>
    </div>
</x-boss.direct-templates.container>
@endsection

@push('styles')
<style>
    .campaign-nav-item .nav-link {
        padding: 0.5rem 1rem;
        color: #495057;
        text-decoration: none;
    }

    .campaign-nav-item .nav-link:hover {
        color: #212529;
        background-color: #f8f9fa;
    }

    .campaign-nav-item .nav-link.active {
        color: #fff;
        background-color: #0d6efd;
    }

    .campaign-nav-item .nav-link.active:hover {
        color: #fff;
    }

    .campaign-toggle-icon {
        transition: transform 0.2s;
    }

    .campaign-nav-item .nav-link[aria-expanded="false"] .campaign-toggle-icon {
        transform: rotate(-90deg);
    }

    pre {
        max-height: 300px;
        overflow-y: auto;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Функция для проверки выбранных платформ
        function checkPlatforms() {
            const searchPlatforms = ['SearchResult', 'DynamicPlaces', 'ProductGallery', 'SearchOrganizationList'];
            const networkPlatforms = ['Network', 'Maps'];
            
            const hasSearch = searchPlatforms.some(platform => 
                document.getElementById(`platforms_${platform}`).checked
            );
            const hasNetwork = networkPlatforms.some(platform => 
                document.getElementById(`platforms_${platform}`).checked
            );

            // Обновляем доступность опций в выпадающем списке стратегий
            const strategySelect = document.getElementById('strategy_type');
            const searchOnlyOptions = strategySelect.querySelectorAll('.search-only');
            
            searchOnlyOptions.forEach(option => {
                if (hasNetwork) {
                    option.style.display = 'none';
                    if (option.selected) {
                        strategySelect.value = '';
                        updateStrategyParams('', 'strategy_params', 'strategy_specific_params');
                    }
                } else {
                    option.style.display = '';
                }
            });
        }

        // Функция для обновления параметров стратегии
        function updateStrategyParams(strategyType, containerId, specificParamsId) {
            const container = document.getElementById(containerId);
            const specificParams = document.getElementById(specificParamsId);
            
            if (!strategyType) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            specificParams.innerHTML = '';

            // Добавляем специфические параметры в зависимости от типа стратегии
            switch(strategyType) {
                case 'WB_MAXIMUM_CLICKS':
                    specificParams.innerHTML = `
                        <div class="form-group mb-3">
                            <label for="payment_type">Тип оплаты</label>
                            <select class="form-select" id="payment_type" name="payment_type">
                                <option value="CLICKS">Оплата за клики</option>
                            </select>
                        </div>
                    `;
                    break;
                case 'WB_MAXIMUM_CONVERSIONS':
                    specificParams.innerHTML = `
                        <div class="form-group mb-3">
                            <label for="payment_type">Тип оплаты</label>
                            <select class="form-select" id="payment_type" name="payment_type">
                                <option value="CLICKS">Оплата за клики</option>
                                <option value="CONVERSIONS">Оплата за конверсии</option>
                            </select>
                        </div>
                    `;
                    break;
                case 'AVERAGE_CPC':
                    specificParams.innerHTML = `
                        <div class="form-group mb-3">
                            <label for="average_cpc">Средняя цена клика (руб.)</label>
                            <input type="number" class="form-control" 
                                   id="average_cpc" name="average_cpc" 
                                   step="0.01" min="0">
                        </div>
                        <div class="form-group mb-3">
                            <label for="payment_type">Тип оплаты</label>
                            <select class="form-select" id="payment_type" name="payment_type">
                                <option value="CLICKS">Оплата за клики</option>
                            </select>
                        </div>
                    `;
                    break;
            }
        }

        // Обработчики изменения платформ
        document.querySelectorAll('.platform-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const requiredId = this.dataset.requires;
                if (requiredId) {
                    const requiredCheckbox = document.getElementById(requiredId);
                    if (this.checked && !requiredCheckbox.checked) {
                        requiredCheckbox.checked = true;
                    }
                }
                checkPlatforms();
            });
        });

        // Обработчик изменения типа стратегии
        document.getElementById('strategy_type').addEventListener('change', function() {
            updateStrategyParams(this.value, 'strategy_params', 'strategy_specific_params');
        });

        // Инициализация при загрузке страницы
        checkPlatforms();
        const strategyType = document.getElementById('strategy_type').value;
        if (strategyType) {
            updateStrategyParams(strategyType, 'strategy_params', 'strategy_specific_params');
        }

        // Отладочная информация
        const form = document.getElementById('settingsForm');
        const formDataElement = document.getElementById('formData');
        const serverResponseElement = document.getElementById('serverResponse');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Собираем данные формы
            const formData = new FormData(form);
            const data = {};
            for (let [key, value] of formData.entries()) {
                // Обработка массивов (например, platforms[])
                if (key.endsWith('[]')) {
                    const baseKey = key.slice(0, -2);
                    if (!data[baseKey]) {
                        data[baseKey] = [];
                    }
                    data[baseKey].push(value);
                } else {
                    data[key] = value;
                }
            }
            
            // ВРЕМЕННО: Выводим собранные данные в отладочную информацию
            console.log('Собранные данные формы:', data);
            formDataElement.textContent = JSON.stringify(data, null, 2);
            serverResponseElement.textContent = 'ВРЕМЕННО: Отправка данных отключена для отладки';

            /* ВРЕМЕННО ЗАКОММЕНТИРОВАНО: Оригинальный код отправки данных
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
            */
        });
    });
</script>
@endpush 