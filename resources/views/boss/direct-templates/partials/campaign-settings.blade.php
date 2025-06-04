@php
    $isNew = !isset($direct_template->id);
    $route = $isNew ? route('boss.direct-templates.campaigns.store', $template) : route('boss.direct-templates.campaigns.update', [$template, $direct_template]);
    $method = $isNew ? 'POST' : 'PUT';
@endphp

<form action="{{ $route }}" method="POST">
    @csrf
    @if(!$isNew)
        @method('PUT')
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Настройки кампании</h5>
            
            <div class="mb-3">
                <label for="name" class="form-label">Название кампании</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $direct_template->name ?? '') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="url" class="form-label">Рекламируемая страница</label>
                <input type="url" class="form-control @error('url') is-invalid @enderror" 
                       id="url" name="url" value="{{ old('url', $direct_template->url ?? '') }}" required>
                @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $direct_template->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="daily_budget" class="form-label">Дневной бюджет</label>
                <div class="input-group">
                    <input type="number" step="0.01" min="0" class="form-control @error('daily_budget') is-invalid @enderror" 
                           id="daily_budget" name="daily_budget" value="{{ old('daily_budget', $direct_template->daily_budget ?? '') }}" required>
                    <span class="input-group-text">₽</span>
                </div>
                @error('daily_budget')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Дата начала</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                           id="start_date" name="start_date" value="{{ old('start_date', $direct_template->start_date ?? '') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">Дата окончания</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                           id="end_date" name="end_date" value="{{ old('end_date', $direct_template->end_date ?? '') }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Статус кампании</label>
                <select class="form-select @error('status') is-invalid @enderror" 
                        id="status" name="status" required>
                    <option value="active" {{ old('status', $direct_template->status ?? '') == 'active' ? 'selected' : '' }}>Активна</option>
                    <option value="paused" {{ old('status', $direct_template->status ?? '') == 'paused' ? 'selected' : '' }}>На паузе</option>
                    <option value="stopped" {{ old('status', $direct_template->status ?? '') == 'stopped' ? 'selected' : '' }}>Остановлена</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">Места показа</h6>
                        
                        <div class="mb-4">
                            <h6 class="h6 mb-2">Поиск</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="platforms[ProductGallery]" 
                                       id="placement_product_gallery" value="YES" 
                                       {{ old('platforms.ProductGallery', $direct_template->platforms['ProductGallery'] ?? '') == 'YES' ? 'checked' : '' }}>
                                <label class="form-check-label" for="placement_product_gallery">
                                    Товарная галерея на поиске
                                </label>
                                <small class="form-text text-muted d-block">
                                    Покажите свои предложения в карусели товаров из разных магазинов, которая появляется над результатами поиска
                                </small>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="platforms[SearchResult]" 
                                       id="placement_search_result" value="YES" 
                                       {{ old('platforms.SearchResult', $direct_template->platforms['SearchResult'] ?? '') == 'YES' ? 'checked' : '' }}>
                                <label class="form-check-label" for="placement_search_result">
                                    Реклама в поисковой выдаче
                                </label>
                                <small class="form-text text-muted d-block">
                                    Разместите свои объявления в специальных рекламных блоках на страницах результатов поиска
                                </small>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="platforms[DynamicPlaces]" 
                                       id="placement_dynamic_places" value="YES" 
                                       {{ old('platforms.DynamicPlaces', $direct_template->platforms['DynamicPlaces'] ?? '') == 'YES' ? 'checked' : '' }}>
                                <label class="form-check-label" for="placement_dynamic_places">
                                    Динамические места на поиске
                                </label>
                                <small class="form-text text-muted d-block">
                                    Получайте дополнительные конверсии, повышая видимость своих страниц в поиске по товарам и услугам
                                </small>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="platforms[SearchOrganizationList]" 
                                       id="placement_search_organization_list" value="YES" 
                                       {{ old('platforms.SearchOrganizationList', $direct_template->platforms['SearchOrganizationList'] ?? '') == 'YES' ? 'checked' : '' }}>
                                <label class="form-check-label" for="placement_search_organization_list">
                                    Список организаций в результатах поиска
                                </label>
                                <small class="form-text text-muted d-block">
                                    Станьте заметнее среди других организаций из Яндекс Бизнеса, которые появляются над результатами поиска. Пользователи могут делать запросы в поиске Яндекса или в приложениях с Алисой
                                </small>
                            </div>
                        </div>

                        <div>
                            <h6 class="h6 mb-2">Другие площадки</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="platforms[Network]" 
                                       id="placement_network" value="YES" 
                                       {{ old('platforms.Network', $direct_template->platforms['Network'] ?? '') == 'YES' ? 'checked' : '' }}>
                                <label class="form-check-label" for="placement_network">
                                    Рекламная сеть Яндекса
                                </label>
                                <small class="form-text text-muted d-block">
                                    Охватите посетителей десятков тысяч сайтов и приложений, которым могут быть интересны ваши товары и услуги
                                </small>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="platforms[Maps]" 
                                       id="placement_maps" value="YES" 
                                       {{ old('platforms.Maps', $direct_template->platforms['Maps'] ?? '') == 'YES' ? 'checked' : '' }}>
                                <label class="form-check-label" for="placement_maps">
                                    Яндекс Карты
                                </label>
                                <small class="form-text text-muted d-block">
                                    Поднимитесь в поиске Карт и выделитесь среди других организаций благодаря зелёной метке. Пользователи могут делать запросы в поиске Карт или в приложениях с Алисой
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">Стратегия</h6>
                        
                        <div class="mb-3">
                            <label for="strategy_type" class="form-label">Стратегия</label>
                            <select class="form-select @error('strategy_type') is-invalid @enderror" 
                                    id="strategy_type" name="strategy_type" required>
                                <option value="">Выберите стратегию</option>
                                <option value="max_clicks" {{ old('strategy_type', $direct_template->strategy_type ?? '') == 'max_clicks' ? 'selected' : '' }}>Максимум кликов</option>
                                <option value="max_conversions" {{ old('strategy_type', $direct_template->strategy_type ?? '') == 'max_conversions' ? 'selected' : '' }}>Максимум конверсий</option>
                                <option value="max_clicks_manual" {{ old('strategy_type', $direct_template->strategy_type ?? '') == 'max_clicks_manual' ? 'selected' : '' }}>Максимум кликов с ручным управлением</option>
                            </select>
                            @error('strategy_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Поля для стратегии "Максимум кликов" -->
                        <div id="max_clicks_fields" class="strategy-fields" style="display: none;">
                            <div class="mb-3">
                                <label for="max_clicks_spend_limit" class="form-label">Ограничение расхода</label>
                                <select class="form-select @error('max_clicks_spend_limit') is-invalid @enderror" 
                                        id="max_clicks_spend_limit" name="max_clicks_spend_limit">
                                    <option value="budget" {{ old('max_clicks_spend_limit', $direct_template->bidding_strategy['spend_limit'] ?? '') == 'budget' ? 'selected' : '' }}>Бюджет</option>
                                    <option value="avg_click_price" {{ old('max_clicks_spend_limit', $direct_template->bidding_strategy['spend_limit'] ?? '') == 'avg_click_price' ? 'selected' : '' }}>Средняя цена клика</option>
                                </select>
                                @error('max_clicks_spend_limit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Поля для стратегии "Максимум конверсий" -->
                        <div id="max_conversions_fields" class="strategy-fields" style="display: none;">
                            <div class="mb-3">
                                <label for="max_conversions_payment_type" class="form-label">С оплатой</label>
                                <select class="form-select @error('max_conversions_payment_type') is-invalid @enderror" 
                                        id="max_conversions_payment_type" name="max_conversions_payment_type">
                                    <option value="clicks" {{ old('max_conversions_payment_type', $direct_template->bidding_strategy['payment_type'] ?? '') == 'clicks' ? 'selected' : '' }}>За клики</option>
                                    <option value="conversions" {{ old('max_conversions_payment_type', $direct_template->bidding_strategy['payment_type'] ?? '') == 'conversions' ? 'selected' : '' }}>За конверсии</option>
                                </select>
                                @error('max_conversions_payment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Поля для оплаты за клики -->
                            <div id="max_conversions_clicks_fields" class="payment-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="max_conversions_clicks_spend_limit" class="form-label">Ограничение расхода</label>
                                    <select class="form-select @error('max_conversions_clicks_spend_limit') is-invalid @enderror" 
                                            id="max_conversions_clicks_spend_limit" name="max_conversions_clicks_spend_limit">
                                        <option value="budget" {{ old('max_conversions_clicks_spend_limit', $direct_template->bidding_strategy['clicks_spend_limit'] ?? '') == 'budget' ? 'selected' : '' }}>Бюджет</option>
                                        <option value="avg_conversion_price" {{ old('max_conversions_clicks_spend_limit', $direct_template->bidding_strategy['clicks_spend_limit'] ?? '') == 'avg_conversion_price' ? 'selected' : '' }}>Средняя цена конверсии</option>
                                        <option value="ad_spend_share" {{ old('max_conversions_clicks_spend_limit', $direct_template->bidding_strategy['clicks_spend_limit'] ?? '') == 'ad_spend_share' ? 'selected' : '' }}>Доля рекламных расходов</option>
                                    </select>
                                    @error('max_conversions_clicks_spend_limit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">Счётчики и цели</h6>
                        
                        <div class="mb-3">
                            <label for="counter_ids" class="form-label">Счётчики Яндекс.Метрики</label>
                            <select class="form-select @error('counter_ids') is-invalid @enderror" 
                                    id="counter_ids" name="counter_ids[]" multiple>
                                <!-- Здесь будут загружаться счётчики из API -->
                            </select>
                            @error('counter_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="goals" class="form-label">Цели</label>
                            <select class="form-select @error('goals') is-invalid @enderror" 
                                    id="goals" name="goals[]" multiple>
                                <!-- Здесь будут загружаться цели из API -->
                            </select>
                            @error('goals')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ $isNew ? 'Создать кампанию' : 'Сохранить изменения' }}</button>
                <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-secondary">Отмена</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработка изменения стратегии
    const strategySelect = document.getElementById('strategy_type');
    const strategyFields = document.querySelectorAll('.strategy-fields');
    const placementCheckboxes = document.querySelectorAll('input[name^="platforms"]');

    // Функция проверки доступности стратегий
    function updateAvailableStrategies() {
        const productGallery = document.getElementById('placement_product_gallery').checked;
        const searchResult = document.getElementById('placement_search_result').checked;
        const dynamicPlaces = document.getElementById('placement_dynamic_places').checked;
        const network = document.getElementById('placement_network').checked;
        const maps = document.getElementById('placement_maps').checked;

        // Скрываем все опции стратегий
        Array.from(strategySelect.options).forEach(option => {
            if (option.value) {
                option.style.display = 'none';
            }
        });

        // Показываем доступные стратегии в зависимости от выбранных мест показа
        if (productGallery || (searchResult && dynamicPlaces) || searchResult) {
            strategySelect.querySelector('option[value="max_clicks"]').style.display = '';
            strategySelect.querySelector('option[value="max_conversions"]').style.display = '';
            strategySelect.querySelector('option[value="max_clicks_manual"]').style.display = '';
        }
        if (network || maps) {
            strategySelect.querySelector('option[value="max_clicks"]').style.display = '';
            strategySelect.querySelector('option[value="max_conversions"]').style.display = '';
        }

        // Если текущая выбранная стратегия недоступна, сбрасываем выбор
        if (strategySelect.value && strategySelect.selectedOptions[0].style.display === 'none') {
            strategySelect.value = '';
            updateStrategyFields();
        }
    }

    // Обработка изменения мест показа
    placementCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Проверяем зависимость между "Реклама в поисковой выдаче" и "Динамические места на поиске"
            if (this.id === 'placement_search_result' && !this.checked) {
                document.getElementById('placement_dynamic_places').checked = false;
            }
            if (this.id === 'placement_dynamic_places' && this.checked) {
                document.getElementById('placement_search_result').checked = true;
            }
            updateAvailableStrategies();
        });
    });

    function updateStrategyFields() {
        const selectedStrategy = strategySelect.value;
        strategyFields.forEach(field => {
            field.style.display = 'none';
        });

        if (selectedStrategy) {
            document.getElementById(selectedStrategy + '_fields').style.display = 'block';

            // Обработка дополнительных полей для стратегии "Максимум конверсий"
            if (selectedStrategy === 'max_conversions') {
                const paymentType = document.getElementById('max_conversions_payment_type');
                const paymentFields = document.querySelectorAll('.payment-fields');
                paymentFields.forEach(field => field.style.display = 'none');

                if (paymentType.value === 'clicks') {
                    document.getElementById('max_conversions_clicks_fields').style.display = 'block';
                }
            }
        }
    }

    // Обработчики событий для дополнительных полей
    document.getElementById('max_conversions_payment_type').addEventListener('change', function() {
        const paymentFields = document.querySelectorAll('.payment-fields');
        paymentFields.forEach(field => field.style.display = 'none');

        if (this.value === 'clicks') {
            document.getElementById('max_conversions_clicks_fields').style.display = 'block';
        }
    });

    strategySelect.addEventListener('change', updateStrategyFields);
    updateStrategyFields(); // Инициализация при загрузке страницы
    updateAvailableStrategies(); // Инициализация доступных стратегий

    // Инициализация Select2 для множественного выбора
    $('#counter_ids').select2({
        placeholder: 'Выберите счётчики',
        allowClear: true
    });

    $('#goals').select2({
        placeholder: 'Выберите цели',
        allowClear: true
    });

    // Установка минимальной даты начала как сегодняшней
    document.getElementById('start_date').min = new Date().toISOString().split('T')[0];
    
    // Установка минимальной даты окончания как даты начала
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('end_date').min = this.value;
    });
});
</script>
@endpush 