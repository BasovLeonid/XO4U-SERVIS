@extends('boss.layouts.app')

@section('title', 'Создание кампании')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0">Создание кампании для шаблона "{{ $template->name }}"</h1>
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

                        @foreach($template->campaigns as $campaign)
                            <div class="campaign-nav-item">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a class="nav-link flex-grow-1" href="#" data-bs-toggle="collapse" 
                                       data-bs-target="#campaign-{{ $campaign->id }}-nav">
                                        <i class="fas fa-ad me-2"></i>{{ $campaign->name }}
                                        <i class="fas fa-minus ms-2 campaign-toggle-icon"></i>
                                    </a>
                                </div>
                                <div class="collapse show" id="campaign-{{ $campaign->id }}-nav">
                                    <div class="nav flex-column nav-pills ms-3">
                                        <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.edit', [$template, $campaign]) }}">
                                            <i class="fas fa-sliders-h me-2"></i>Настройки кампании
                                        </a>
                                        <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaign]) }}">
                                            <i class="fas fa-cogs me-2"></i>Дополнительные настройки
                                        </a>
                                        <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.limits', [$template, $campaign]) }}">
                                            <i class="fas fa-ban me-2"></i>Ограничения
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top my-3"></div>
                        @endforeach

                        <a class="nav-link active" href="{{ route('boss.direct-templates.campaigns.create', $template) }}">
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
                    <form action="{{ route('boss.direct-templates.campaigns.store', $template) }}" method="POST">
                        @csrf

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Основные настройки кампании</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="name">Название кампании</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status">Статус кампании</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Активна</option>
                                        <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>На паузе</option>
                                        <option value="stopped" {{ old('status') == 'stopped' ? 'selected' : '' }}>Остановлена</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="url">Рекламируемая страница</label>
                                    <input type="url" class="form-control @error('url') is-invalid @enderror" 
                                           id="url" name="url" value="{{ old('url') }}" required>
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Места показа</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="mb-3">Поиск</h6>
                                <div class="form-check mb-3">
                                    <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[ProductGallery]" 
                                           id="platforms_ProductGallery" value="YES" 
                                           {{ old('platforms.ProductGallery') == 'YES' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platforms_ProductGallery">
                                        Товарная галерея на поиске
                                        <small class="d-block text-muted">Покажите свои предложения в карусели товаров из разных магазинов, которая появляется над результатами поиска</small>
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[SearchResult]" 
                                           id="platforms_SearchResult" value="YES" 
                                           {{ old('platforms.SearchResult') == 'YES' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platforms_SearchResult">
                                        Реклама в поисковой выдаче
                                        <small class="d-block text-muted">Разместите свои объявления в специальных рекламных блоках на страницах результатов поиска</small>
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[DynamicPlaces]" 
                                           id="platforms_DynamicPlaces" value="YES" 
                                           {{ old('platforms.DynamicPlaces') == 'YES' ? 'checked' : '' }}
                                           data-requires="platforms_SearchResult">
                                    <label class="form-check-label" for="platforms_DynamicPlaces">
                                        Динамические места на поиске
                                        <small class="d-block text-muted">Получайте дополнительные конверсии, повышая видимость своих страниц в поиске по товарам и услугам</small>
                                    </label>
                                </div>

                                <div class="form-check mb-4">
                                    <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[SearchOrganizationList]" 
                                           id="platforms_SearchOrganizationList" value="YES" 
                                           {{ old('platforms.SearchOrganizationList') == 'YES' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platforms_SearchOrganizationList">
                                        Список организаций в результатах поиска
                                        <small class="d-block text-muted">Станьте заметнее среди других организаций из Яндекс Бизнеса, которые появляются над результатами поиска</small>
                                    </label>
                                </div>

                                <h6 class="mb-3">Другие площадки</h6>
                                <div class="form-check mb-3">
                                    <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[Network]" 
                                           id="platforms_Network" value="YES" 
                                           {{ old('platforms.Network') == 'YES' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platforms_Network">
                                        Рекламная сеть Яндекса
                                        <small class="d-block text-muted">Охватите посетителей десятков тысяч сайтов и приложений, которым могут быть интересны ваши товары и услуги</small>
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[Maps]" 
                                           id="platforms_Maps" value="YES" 
                                           {{ old('platforms.Maps') == 'YES' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="platforms_Maps">
                                        Яндекс Карты
                                        <small class="d-block text-muted">Поднимитесь в поиске Карт и выделитесь среди других организаций благодаря зелёной метке</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Стратегия</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="strategy_type">Стратегия</label>
                                    <select class="form-select @error('strategy_type') is-invalid @enderror" 
                                            id="strategy_type" name="strategy_type" required>
                                        <option value="max_clicks" {{ old('strategy_type') == 'max_clicks' ? 'selected' : '' }}>Максимум кликов</option>
                                        <option value="max_conversions" {{ old('strategy_type') == 'max_conversions' ? 'selected' : '' }}>Максимум конверсий</option>
                                        <option value="max_clicks_manual" {{ old('strategy_type') == 'max_clicks_manual' ? 'selected' : '' }}>Максимум кликов с ручным управлением</option>
                                    </select>
                                    @error('strategy_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Максимум кликов -->
                                <div id="max_clicks_settings" class="strategy-settings" style="display: none;">
                                    <div class="form-group mb-3">
                                        <label for="weekly_budget">Бюджет в неделю (руб.)</label>
                                        <input type="number" class="form-control @error('weekly_budget') is-invalid @enderror" 
                                               id="weekly_budget" name="weekly_budget" value="{{ old('weekly_budget') }}" step="0.01" min="0">
                                        @error('weekly_budget')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="max_clicks_payment_type">С оплатой</label>
                                        <select class="form-select" id="max_clicks_payment_type" name="max_clicks_payment_type">
                                            <option value="clicks" selected>За клики</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="max_clicks_limit_type">Ограничение расхода</label>
                                        <select class="form-select" id="max_clicks_limit_type" name="max_clicks_limit_type">
                                            <option value="budget" selected>Бюджет</option>
                                            <option value="average_cpc">Средняя цена клика</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3" id="max_clicks_average_cpc_field" style="display: none;">
                                        <label for="max_clicks_average_cpc">Средняя цена клика (руб.)</label>
                                        <input type="number" class="form-control" 
                                               id="max_clicks_average_cpc" name="max_clicks_average_cpc" 
                                               value="{{ old('max_clicks_average_cpc') }}" step="0.01" min="0">
                                    </div>
                                </div>

                                <!-- Максимум конверсий -->
                                <div id="max_conversions_settings" class="strategy-settings" style="display: none;">
                                    <div class="form-group mb-3">
                                        <label for="max_conversions_payment_type">С оплатой</label>
                                        <select class="form-select" id="max_conversions_payment_type" name="max_conversions_payment_type">
                                            <option value="clicks" selected>За клики</option>
                                            <option value="conversions">За конверсии</option>
                                        </select>
                                    </div>

                                    <!-- Настройки для оплаты за клики -->
                                    <div id="max_conversions_clicks_settings">
                                        <div class="form-group mb-3">
                                            <label for="max_conversions_clicks_limit_type">Ограничение расхода</label>
                                            <select class="form-select" id="max_conversions_clicks_limit_type" name="max_conversions_clicks_limit_type">
                                                <option value="budget" selected>Бюджет</option>
                                                <option value="average_cpa">Средняя цена конверсии</option>
                                                <option value="crr">Доля рекламных расходов</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3" id="max_conversions_clicks_crr_field" style="display: none;">
                                            <label for="max_conversions_clicks_crr">Доля рекламных расходов (%)</label>
                                            <input type="number" class="form-control" 
                                                   id="max_conversions_clicks_crr" name="max_conversions_clicks_crr" 
                                                   value="{{ old('max_conversions_clicks_crr') }}" step="0.01" min="0" max="100">
                                        </div>
                                    </div>

                                    <!-- Настройки для оплаты за конверсии -->
                                    <div id="max_conversions_conversions_settings" style="display: none;">
                                        <div class="form-group mb-3">
                                            <label for="max_conversions_conversions_limit_type">Ограничение расхода</label>
                                            <select class="form-select" id="max_conversions_conversions_limit_type" name="max_conversions_conversions_limit_type">
                                                <option value="cpa">Цена конверсии</option>
                                                <option value="crr">Доля рекламных расходов</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3" id="max_conversions_conversions_crr_field" style="display: none;">
                                            <label for="max_conversions_conversions_crr">Доля рекламных расходов (%)</label>
                                            <input type="number" class="form-control" 
                                                   id="max_conversions_conversions_crr" name="max_conversions_conversions_crr" 
                                                   value="{{ old('max_conversions_conversions_crr') }}" step="0.01" min="0" max="100">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="max_conversions_weekly_budget">Бюджет в неделю (руб.)</label>
                                        <input type="number" class="form-control" 
                                               id="max_conversions_weekly_budget" name="max_conversions_weekly_budget" 
                                               value="{{ old('max_conversions_weekly_budget') }}" step="0.01" min="0">
                                    </div>
                                </div>

                                <!-- Максимум кликов с ручным управлением -->
                                <div id="max_clicks_manual_settings" class="strategy-settings" style="display: none;">
                                    <div class="form-group mb-3">
                                        <label for="daily_budget">Дневной бюджет (руб.)</label>
                                        <input type="number" class="form-control" 
                                               id="daily_budget" name="daily_budget" 
                                               value="{{ old('daily_budget') }}" step="0.01" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Блок целей Яндекс Метрики -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Цели Яндекс Метрики</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-4">
                                    <label for="metrika_counter_id">ID счетчика Яндекс Метрики</label>
                                    <input type="text" class="form-control @error('metrika_counter_id') is-invalid @enderror" 
                                           id="metrika_counter_id" name="metrika_counter_id" 
                                           value="{{ old('metrika_counter_id') }}" required>
                                    @error('metrika_counter_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="goals_container">
                                    <div class="goals-header mb-3">
                                        <h6>Цели</h6>
                                        <div id="goals_description" class="text-muted small mb-3">
                                            <!-- Описание будет динамически обновляться -->
                                        </div>
                                    </div>

                                    <div id="goals_list">
                                        <!-- Здесь будут динамически добавляться цели -->
                                    </div>

                                    <button type="button" class="btn btn-outline-primary btn-sm mt-3" id="add_goal">
                                        <i class="fas fa-plus me-2"></i>Добавить цель
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Сохранить кампанию
                            </button>
                            <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Отмена
                            </a>
                        </div>
                    </form>

                    @if(config('app.debug'))
                        <div class="card mt-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Отладочная информация</h5>
                            </div>
                            <div class="card-body">
                                <h6>Ошибки валидации:</h6>
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="text-muted">Нет ошибок валидации</p>
                                @endif

                                <h6 class="mt-4">Отправляемые данные:</h6>
                                <pre id="debug-data" class="bg-light p-3 rounded" style="max-height: 300px; overflow-y: auto;"></pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Функция для обновления доступных стратегий
    function updateAvailableStrategies() {
        const strategySelect = document.getElementById('strategy_type');
        const selectedPlatforms = Array.from(document.querySelectorAll('.platform-checkbox:checked')).map(cb => cb.id);
        
        // Скрываем все стратегии
        Array.from(strategySelect.options).forEach(option => {
            option.disabled = true;
        });

        // Определяем доступные стратегии на основе выбранных площадок
        const availableStrategies = new Set();

        // Проверяем каждую платформу
        if (selectedPlatforms.includes('platforms_ProductGallery')) {
            availableStrategies.add('max_clicks');
            availableStrategies.add('max_conversions');
            availableStrategies.add('max_clicks_manual');
        }

        if (selectedPlatforms.includes('platforms_SearchResult')) {
            availableStrategies.add('max_clicks');
            availableStrategies.add('max_conversions');
            availableStrategies.add('max_clicks_manual');
        }

        if (selectedPlatforms.includes('platforms_SearchOrganizationList')) {
            availableStrategies.add('max_clicks');
            availableStrategies.add('max_conversions');
            availableStrategies.add('max_clicks_manual');
        }

        if (selectedPlatforms.includes('platforms_Network')) {
            availableStrategies.add('max_clicks');
            availableStrategies.add('max_conversions');
        }

        if (selectedPlatforms.includes('platforms_Maps')) {
            availableStrategies.add('max_clicks');
            availableStrategies.add('max_conversions');
        }

        // Активируем только те стратегии, которые доступны для всех выбранных площадок
        Array.from(strategySelect.options).forEach(option => {
            option.disabled = !availableStrategies.has(option.value);
        });

        // Если текущая выбранная стратегия недоступна, выбираем первую доступную
        if (strategySelect.options[strategySelect.selectedIndex].disabled) {
            const firstAvailable = Array.from(strategySelect.options).find(option => !option.disabled);
            if (firstAvailable) {
                firstAvailable.selected = true;
                updateStrategySettings();
            }
        }
    }

    // Функция для обновления отображения настроек стратегии
    function updateStrategySettings() {
        const strategyType = document.getElementById('strategy_type').value;
        document.querySelectorAll('.strategy-settings').forEach(el => el.style.display = 'none');
        document.getElementById(strategyType + '_settings').style.display = 'block';
    }

    // Обработчики событий
    document.querySelectorAll('.platform-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Проверяем зависимость DynamicPlaces от SearchResult
            if (this.id === 'platforms_DynamicPlaces' && this.checked) {
                document.getElementById('platforms_SearchResult').checked = true;
            }
            // Если отключаем SearchResult, отключаем и DynamicPlaces
            if (this.id === 'platforms_SearchResult' && !this.checked) {
                document.getElementById('platforms_DynamicPlaces').checked = false;
            }
            updateAvailableStrategies();
        });
    });

    document.getElementById('strategy_type').addEventListener('change', updateStrategySettings);

    // Обработчики для полей ограничений
    document.getElementById('max_clicks_limit_type').addEventListener('change', function() {
        document.getElementById('max_clicks_average_cpc_field').style.display = 
            this.value === 'average_cpc' ? 'block' : 'none';
    });

    document.getElementById('max_conversions_payment_type').addEventListener('change', function() {
        document.getElementById('max_conversions_clicks_settings').style.display = 
            this.value === 'clicks' ? 'block' : 'none';
        document.getElementById('max_conversions_conversions_settings').style.display = 
            this.value === 'conversions' ? 'block' : 'none';
    });

    document.getElementById('max_conversions_clicks_limit_type').addEventListener('change', function() {
        document.getElementById('max_conversions_clicks_crr_field').style.display = 
            this.value === 'crr' ? 'block' : 'none';
    });

    document.getElementById('max_conversions_conversions_limit_type').addEventListener('change', function() {
        document.getElementById('max_conversions_conversions_crr_field').style.display = 
            this.value === 'crr' ? 'block' : 'none';
    });

    // Функция для определения типа значения цели
    function getGoalValueType() {
        const strategyType = document.getElementById('strategy_type').value;
        const paymentType = document.getElementById('max_conversions_payment_type')?.value;
        const limitType = document.getElementById('max_conversions_clicks_limit_type')?.value;

        if (strategyType === 'max_clicks') {
            return 'value';
        } else if (strategyType === 'max_conversions') {
            if (paymentType === 'clicks') {
                if (limitType === 'average_cpa') {
                    return 'price';
                }
                return 'value';
            }
        } else if (strategyType === 'max_clicks_manual') {
            return 'value';
        }

        return 'value'; // По умолчанию
    }

    // Функция для обновления описания целей
    function updateGoalsDescription() {
        const valueType = getGoalValueType();
        const description = valueType === 'value' 
            ? 'Целевые действия и их ценность. Используются для подбора наиболее конверсионного трафика. Ценность — экономическая выгода, получаемая при достижении посетителем этой цели.'
            : 'Целевые действия и их цена. Используются для подбора наиболее конверсионного трафика. Цена — сумма, которую вы готовы платить за достижение посетителем этой цели.';
        
        document.getElementById('goals_description').textContent = description;
    }

    // Функция для создания HTML цели
    function createGoalHtml(index) {
        const valueType = getGoalValueType();
        const valueLabel = valueType === 'value' ? 'Ценность цели' : 'Цена цели';
        const valueName = valueType === 'value' ? 'goal_values' : 'goal_prices';

        return `
            <div class="goal-item mb-3 p-3 border rounded" data-index="${index}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID цели</label>
                            <input type="text" class="form-control" name="goal_ids[]" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>${valueLabel} (руб.)</label>
                            <input type="number" class="form-control" name="${valueName}[]" 
                                   step="0.01" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-goal" 
                                data-index="${index}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Добавление новой цели
    document.getElementById('add_goal').addEventListener('click', function() {
        const goalsList = document.getElementById('goals_list');
        const index = goalsList.children.length;
        goalsList.insertAdjacentHTML('beforeend', createGoalHtml(index));
    });

    // Удаление цели
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-goal')) {
            const goalItem = e.target.closest('.goal-item');
            goalItem.remove();
        }
    });

    // Обновление описания при изменении настроек
    const settingsElements = [
        document.getElementById('strategy_type'),
        document.getElementById('max_conversions_payment_type'),
        document.getElementById('max_conversions_clicks_limit_type')
    ];

    settingsElements.forEach(element => {
        if (element) {
            element.addEventListener('change', function() {
                updateGoalsDescription();
                // Обновляем все существующие цели
                const goalsList = document.getElementById('goals_list');
                const goals = goalsList.children;
                for (let i = 0; i < goals.length; i++) {
                    const goalItem = goals[i];
                    const newHtml = createGoalHtml(i);
                    goalItem.outerHTML = newHtml;
                }
            });
        }
    });

    // Инициализация
    updateAvailableStrategies();
    updateStrategySettings();
    updateGoalsDescription();
    // Добавляем первую цель по умолчанию
    document.getElementById('add_goal').click();

    // Обработка сворачивания/разворачивания кампаний
    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('.campaign-toggle-icon');
            if (icon.classList.contains('fa-minus')) {
                icon.classList.replace('fa-minus', 'fa-plus');
            } else {
                icon.classList.replace('fa-plus', 'fa-minus');
            }
        });
    });

    // Отладочная информация
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const formData = new FormData(this);
        const debugData = {};
        
        for (let [key, value] of formData.entries()) {
            if (key.includes('[]')) {
                const baseKey = key.replace('[]', '');
                if (!debugData[baseKey]) {
                    debugData[baseKey] = [];
                }
                debugData[baseKey].push(value);
            } else {
                debugData[key] = value;
            }
        }
        
        document.getElementById('debug-data').textContent = JSON.stringify(debugData, null, 2);
    });
});
</script>
@endpush

@push('styles')
<style>
.campaign-nav-item .nav-link {
    padding: 0.5rem 1rem;
}

.campaign-nav-item .nav-link[data-bs-toggle="collapse"] {
    cursor: pointer;
}

.campaign-nav-item .nav-link[data-bs-toggle="collapse"]:hover {
    background-color: rgba(0,0,0,0.05);
}

.campaign-nav-item .nav-pills .nav-link {
    padding-left: 2rem;
    font-size: 0.9rem;
}

.border-top {
    border-color: rgba(0,0,0,0.1) !important;
}
</style>
@endpush
@endsection 