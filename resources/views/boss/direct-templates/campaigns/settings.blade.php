@extends('boss.layouts.app')

@section('title', 'Настройки кампании')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0">Настройки кампании "{{ $campaign->name }}"</h1>
        </div>
    </div>

    <div class="row">
        <!-- Левая панель навигации -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom">
                        <h5 class="mb-0">Шаблон</h5>
                        <small class="text-muted">{{ $template->name }}</small>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" href="{{ route('boss.direct-templates.edit', $template) }}">
                            <i class="fas fa-cog me-2"></i>Настройки шаблона
                        </a>

                        <div class="border-top my-3"></div>

                        @foreach($template->campaigns as $campaignItem)
                            <div class="campaign-nav-item">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a class="nav-link flex-grow-1 {{ $campaignItem->id === $campaign->id ? 'active' : '' }}" 
                                       href="#" data-bs-toggle="collapse" 
                                       data-bs-target="#campaign-{{ $campaignItem->id }}-nav">
                                        <i class="fas fa-ad me-2"></i>{{ $campaignItem->name }}
                                        <i class="fas fa-minus ms-2 campaign-toggle-icon"></i>
                                    </a>
                                </div>
                                <div class="collapse {{ $campaignItem->id === $campaign->id ? 'show' : '' }}" 
                                     id="campaign-{{ $campaignItem->id }}-nav">
                                    <div class="nav flex-column nav-pills ms-3">
                                        <a class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.settings') && $campaignItem->id === $campaign->id ? 'active' : '' }}" 
                                           href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaignItem]) }}">
                                            <i class="fas fa-sliders-h me-2"></i>Настройки кампании
                                        </a>
                                        <a class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.additional-settings') && $campaignItem->id === $campaign->id ? 'active' : '' }}" 
                                           href="{{ route('boss.direct-templates.campaigns.additional-settings', [$template, $campaignItem]) }}">
                                            <i class="fas fa-cogs me-2"></i>Дополнительные настройки
                                        </a>
                                        <a class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.limits') && $campaignItem->id === $campaign->id ? 'active' : '' }}" 
                                           href="{{ route('boss.direct-templates.campaigns.limits', [$template, $campaignItem]) }}">
                                            <i class="fas fa-ban me-2"></i>Ограничения
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top my-3"></div>
                        @endforeach

                        <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.create', $template) }}">
                            <i class="fas fa-plus me-2"></i>Добавить кампанию
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Основной контент -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Основные настройки кампании</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="name">Название кампании</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $campaign->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status">Статус кампании</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status', $campaign->status) == 'active' ? 'selected' : '' }}>Активна</option>
                                        <option value="paused" {{ old('status', $campaign->status) == 'paused' ? 'selected' : '' }}>На паузе</option>
                                        <option value="stopped" {{ old('status', $campaign->status) == 'stopped' ? 'selected' : '' }}>Остановлена</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="url">Рекламируемая страница</label>
                                    <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                           id="url" name="url" value="{{ old('url', $campaign->url) }}" required>
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Подключаем форму из advanced_settings.blade.php -->
                        <x-yandex_direct.campaigns.advanced_settings :campaign="$campaign" :counters="$counters" :goals="$goals" />

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
    });
</script>
@endpush 