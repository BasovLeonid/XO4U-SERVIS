@props(['campaign' => null, 'counters' => [], 'goals' => []])

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Места показа</h5>
    </div>
    <div class="card-body">
        <h6 class="mb-3">Поиск</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[SearchResult]" 
                   id="platforms_SearchResult" value="YES" 
                   {{ old('platforms.SearchResult', $campaign?->platforms['SearchResult'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="platforms_SearchResult">
                Реклама в поисковой выдаче
                <small class="d-block text-muted">Разместите свои объявления в специальных рекламных блоках на страницах результатов поиска</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[DynamicPlaces]" 
                   id="platforms_DynamicPlaces" value="YES" 
                   {{ old('platforms.DynamicPlaces', $campaign?->platforms['DynamicPlaces'] ?? '') == 'YES' ? 'checked' : '' }}
                   data-requires="platforms_SearchResult">
            <label class="form-check-label" for="platforms_DynamicPlaces">
                Динамические места на поиске
                <small class="d-block text-muted">Получайте дополнительные конверсии, повышая видимость своих страниц в поиске по товарам и услугам</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[ProductGallery]" 
                   id="platforms_ProductGallery" value="YES" 
                   {{ old('platforms.ProductGallery', $campaign?->platforms['ProductGallery'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="platforms_ProductGallery">
                Товарная галерея на поиске
                <small class="d-block text-muted">Покажите свои предложения в карусели товаров из разных магазинов, которая появляется над результатами поиска</small>
            </label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[SearchOrganizationList]" 
                   id="platforms_SearchOrganizationList" value="YES" 
                   {{ old('platforms.SearchOrganizationList', $campaign?->platforms['SearchOrganizationList'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="platforms_SearchOrganizationList">
                Список организаций в результатах поиска
                <small class="d-block text-muted">Станьте заметнее среди других организаций из Яндекс Бизнеса, которые появляются над результатами поиска</small>
            </label>
        </div>

        <h6 class="mb-3">Сети</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[Network]" 
                   id="platforms_Network" value="YES" 
                   {{ old('platforms.Network', $campaign?->platforms['Network'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="platforms_Network">
                Рекламная сеть Яндекса
                <small class="d-block text-muted">Охватите посетителей десятков тысяч сайтов и приложений, которым могут быть интересны ваши товары и услуги</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="platforms[Maps]" 
                   id="platforms_Maps" value="YES" 
                   {{ old('platforms.Maps', $campaign?->platforms['Maps'] ?? '') == 'YES' ? 'checked' : '' }}>
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
            <label for="strategy_type">Тип стратегии</label>
            <select class="form-select @error('strategy_type') is-invalid @enderror" 
                    id="strategy_type" name="strategy_type">
                <option value="">Выберите стратегию</option>
                <option value="WB_MAXIMUM_CLICKS">Максимум кликов / Оплата за клики</option>
                <option value="WB_MAXIMUM_CONVERSIONS">Максимум конверсий</option>
                <option value="AVERAGE_CPC" class="search-only">Максимум кликов с ручными ставками / Оплата за клики</option>
            </select>
            @error('strategy_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Параметры стратегии -->
        <div id="strategy_params" style="display: none;">
            <!-- Общие параметры -->
            <div class="form-group mb-3">
                <label for="weekly_spend_limit">Лимит расходов в неделю (руб.)</label>
                <input type="number" class="form-control" 
                       id="weekly_spend_limit" name="weekly_spend_limit" 
                       step="0.01" min="0">
            </div>

            <!-- Специфические параметры -->
            <div id="strategy_specific_params"></div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Цели Яндекс Метрики</h5>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="counter_ids">Счетчики Яндекс.Метрики</label>
            <select class="form-select" id="counter_ids" name="counter_ids[]" multiple>
                @foreach($counters as $counter)
                    <option value="{{ $counter->id }}" 
                        {{ in_array($counter->id, old('counter_ids', $campaign?->counter_ids ?? [])) ? 'selected' : '' }}>
                        {{ $counter->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="goals">Цели</label>
            <select class="form-select" id="goals" name="goals[]" multiple>
                @foreach($goals as $goal)
                    <option value="{{ $goal->id }}"
                        {{ in_array($goal->id, old('goals', $campaign?->goals ?? [])) ? 'selected' : '' }}>
                        {{ $goal->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Стратегии показа (API)</h5>
    </div>
    <div class="card-body">
        <!-- Стратегии для поиска -->
        <div class="mb-4">
            <h6 class="mb-3">Стратегии для поиска</h6>
            <div class="form-group mb-3">
                <label for="search_strategy_type">Тип стратегии</label>
                <select class="form-select" id="search_strategy_type" name="search_strategy_type">
                    <option value="WB_MAXIMUM_CLICKS">Оптимизация кликов</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE">Оптимизация конверсий</option>
                    <option value="AVERAGE_CPC">Средняя цена клика</option>
                    <option value="AVERAGE_CPA">Средняя цена конверсии</option>
                    <option value="AVERAGE_CRR">Средняя доля расходов</option>
                    <option value="HIGHEST_POSITION">Максимальная позиция</option>
                    <option value="PAY_FOR_CONVERSION">Оплата за конверсии</option>
                    <option value="PAY_FOR_CONVERSION_CRR">Оплата за конверсии с долей расходов</option>
                    <option value="SERVING_OFF">Отключить показы</option>
                </select>
            </div>

            <!-- Параметры стратегии для поиска -->
            <div id="search_strategy_params">
                <!-- WB_MAXIMUM_CLICKS -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CLICKS">
                    <div class="form-group mb-3">
                        <label for="search_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_weekly_spend_limit" name="search_weekly_spend_limit" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_bid_ceiling" name="search_bid_ceiling" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpc" name="search_average_cpc" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_weekly_spend_limit_cpc">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_weekly_spend_limit_cpc" name="search_weekly_spend_limit_cpc" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpa">Средняя цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa" name="search_average_cpa" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_goal_id_cpa">ID цели</label>
                        <select class="form-select" id="search_goal_id_cpa" name="search_goal_id_cpa">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_weekly_spend_limit_cpa">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_weekly_spend_limit_cpa" name="search_weekly_spend_limit_cpa" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CRR -->
                <div class="strategy-params" data-strategy="AVERAGE_CRR" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_crr">Средняя доля расходов (%)</label>
                        <input type="number" class="form-control" id="search_crr" name="search_crr" step="0.01" min="0" max="100">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_goal_id_crr">ID цели</label>
                        <select class="form-select" id="search_goal_id_crr" name="search_goal_id_crr">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_cpa">Цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="search_cpa" name="search_cpa" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_goal_id_pfc">ID цели</label>
                        <select class="form-select" id="search_goal_id_pfc" name="search_goal_id_pfc">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Стратегии для сетей -->
        <div class="mb-4">
            <h6 class="mb-3">Стратегии для сетей</h6>
            <div class="form-group mb-3">
                <label for="network_strategy_type">Тип стратегии</label>
                <select class="form-select" id="network_strategy_type" name="network_strategy_type">
                    <option value="NETWORK_DEFAULT">По умолчанию</option>
                    <option value="WB_MAXIMUM_CLICKS">Оптимизация кликов</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE">Оптимизация конверсий</option>
                    <option value="AVERAGE_CPC">Средняя цена клика</option>
                    <option value="AVERAGE_CPA">Средняя цена конверсии</option>
                    <option value="AVERAGE_CRR">Средняя доля расходов</option>
                    <option value="PAY_FOR_CONVERSION">Оплата за конверсии</option>
                    <option value="PAY_FOR_CONVERSION_CRR">Оплата за конверсии с долей расходов</option>
                    <option value="SERVING_OFF">Отключить показы</option>
                </select>
            </div>

            <!-- Параметры стратегии для сетей -->
            <div id="network_strategy_params">
                <!-- WB_MAXIMUM_CLICKS -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CLICKS">
                    <div class="form-group mb-3">
                        <label for="network_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_weekly_spend_limit" name="network_weekly_spend_limit" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_bid_ceiling" name="network_bid_ceiling" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpc" name="network_average_cpc" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_weekly_spend_limit_cpc">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_weekly_spend_limit_cpc" name="network_weekly_spend_limit_cpc" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpa">Средняя цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa" name="network_average_cpa" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_goal_id_cpa">ID цели</label>
                        <select class="form-select" id="network_goal_id_cpa" name="network_goal_id_cpa">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_weekly_spend_limit_cpa">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_weekly_spend_limit_cpa" name="network_weekly_spend_limit_cpa" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CRR -->
                <div class="strategy-params" data-strategy="AVERAGE_CRR" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_crr">Средняя доля расходов (%)</label>
                        <input type="number" class="form-control" id="network_crr" name="network_crr" step="0.01" min="0" max="100">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_goal_id_crr">ID цели</label>
                        <select class="form-select" id="network_goal_id_crr" name="network_goal_id_crr">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_cpa">Цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="network_cpa" name="network_cpa" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_goal_id_pfc">ID цели</label>
                        <select class="form-select" id="network_goal_id_pfc" name="network_goal_id_pfc">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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