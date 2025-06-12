@props(['campaign' => null, 'counters' => [], 'goals' => []])


<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Места показа</h5>
    </div>
    <div class="card-body">
        <h6 class="mb-3">Поиск</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_result" 
                   id="search_result" value="YES" 
                   {{ old('search_result', $campaign?->search_result) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="search_result">
                Реклама в поисковой выдаче
                <small class="d-block text-muted">Разместите свои объявления в специальных рекламных блоках на страницах результатов поиска</small>
            </label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="dynamic_places" 
                   id="dynamic_places" value="YES" 
                   {{ old('dynamic_places', $campaign?->dynamic_places) == 'YES' ? 'checked' : '' }}
                   data-requires="search_result">
            <label class="form-check-label" for="dynamic_places">
                Динамические места на поиске
                <small class="d-block text-muted">Получайте дополнительные конверсии, повышая видимость своих страниц в поиске по товарам и услугам</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="product_gallery" 
                   id="product_gallery" value="YES" 
                   {{ old('product_gallery', $campaign?->product_gallery) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="product_gallery">
                Товарная галерея на поиске
                <small class="d-block text-muted">Покажите свои предложения в карусели товаров из разных магазинов, которая появляется над результатами поиска</small>
            </label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_organization_list" 
                   id="search_organization_list" value="YES" 
                   {{ old('search_organization_list', $campaign?->search_organization_list) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="search_organization_list">
                Список организаций в результатах поиска
                <small class="d-block text-muted">Станьте заметнее среди других организаций из Яндекс Бизнеса, которые появляются над результатами поиска</small>
            </label>
        </div>

        <h6 class="mb-3">Сети</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="network" 
                   id="network" value="YES" 
                   {{ old('network', $campaign?->network) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="network">
                Рекламная сеть Яндекса
                <small class="d-block text-muted">Охватите посетителей десятков тысяч сайтов и приложений, которым могут быть интересны ваши товары и услуги</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="maps" 
                   id="maps" value="YES" 
                   {{ old('maps', $campaign?->maps) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="maps">
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
        <!-- Стратегии для поиска -->
        <div id="search_strategy_block" class="mb-4" style="display: none;">
            <h6 class="mb-3">Стратегии для поиска</h6>
            <div class="form-group mb-3">
                <label for="search_strategy_type">Тип стратегии</label>
                <select class="form-select" id="search_strategy_type" name="search_strategy_type">
                    <option value="">Выберите стратегию</option>
                    <option value="HIGHEST_POSITION" {{ old('search_strategy_type', $campaign->searchStrategies?->search_strategy_type) == 'HIGHEST_POSITION' ? 'selected' : '' }}>Максимум кликов с ручными ставками</option>
                    <option value="WB_MAXIMUM_CLICKS" {{ old('search_strategy_type', $campaign->searchStrategies?->search_strategy_type) == 'WB_MAXIMUM_CLICKS' ? 'selected' : '' }}>Максимум кликов</option>
                    <option value="AVERAGE_CPC" {{ old('search_strategy_type', $campaign->searchStrategies?->search_strategy_type) == 'AVERAGE_CPC' ? 'selected' : '' }}>Максимум кликов по средней цене</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE" {{ old('search_strategy_type', $campaign->searchStrategies?->search_strategy_type) == 'WB_MAXIMUM_CONVERSION_RATE' ? 'selected' : '' }}>Максимум конверсий</option>
                    <option value="AVERAGE_CPA" {{ old('search_strategy_type', $campaign->searchStrategies?->search_strategy_type) == 'AVERAGE_CPA' ? 'selected' : '' }}>Максимум конверсий по средней цене</option>
                    <option value="PAY_FOR_CONVERSION" {{ old('search_strategy_type', $campaign->searchStrategies?->search_strategy_type) == 'PAY_FOR_CONVERSION' ? 'selected' : '' }}>Оплата за конверсии</option>
                </select>
            </div>

            <!-- Параметры стратегии для поиска -->
            <div id="search_strategy_params">
                <!-- HIGHEST_POSITION -->
                <div class="strategy-params" data-strategy="HIGHEST_POSITION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_daily_budget">Дневной бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_daily_budget" name="daily_budget_amount" step="0.01" min="0" value="{{ old('daily_budget_amount', $campaign->searchStrategies?->daily_budget_amount) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_daily_budget_mode">Режим дневного бюджета</label>
                        <select class="form-select" id="search_daily_budget_mode" name="daily_budget_mode">
                            <option value="STANDARD" @selected(old('daily_budget_mode', $campaign->searchStrategies?->daily_budget_mode) == 'STANDARD')>Стандартный</option>
                            <option value="DISTRIBUTED" @selected(old('daily_budget_mode', $campaign->searchStrategies?->daily_budget_mode) == 'DISTRIBUTED')>Распределенный</option>
                        </select>
                    </div>
                </div>

                <!-- WB_MAXIMUM_CLICKS -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CLICKS" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_clicks_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_clicks_weekly_spend_limit" 
                               name="search_wb_maximum_clicks_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_clicks_weekly_spend_limit', $campaign->searchStrategies?->search_wb_maximum_clicks_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_clicks_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_clicks_bid_ceiling" 
                               name="search_wb_maximum_clicks_bid_ceiling" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_clicks_bid_ceiling', $campaign->searchStrategies?->search_wb_maximum_clicks_bid_ceiling) }}">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpc_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpc_average_cpc" 
                               name="search_average_cpc_average_cpc" step="0.01" min="0"
                               value="{{ old('search_average_cpc_average_cpc', $campaign->searchStrategies?->search_average_cpc_average_cpc) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_average_cpc_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpc_weekly_spend_limit" 
                               name="search_average_cpc_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_average_cpc_weekly_spend_limit', $campaign->searchStrategies?->search_average_cpc_weekly_spend_limit) }}">
                    </div>
                </div>

                <!-- WB_MAXIMUM_CONVERSION_RATE -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CONVERSION_RATE" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_conversion_rate_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_conversion_rate_weekly_spend_limit" 
                               name="search_wb_maximum_conversion_rate_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_conversion_rate_weekly_spend_limit', $campaign->searchStrategies?->search_wb_maximum_conversion_rate_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_conversion_rate_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_conversion_rate_bid_ceiling" 
                               name="search_wb_maximum_conversion_rate_bid_ceiling" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_conversion_rate_bid_ceiling', $campaign->searchStrategies?->search_wb_maximum_conversion_rate_bid_ceiling) }}">
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpa_average_cpa">Средняя цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa_average_cpa" 
                               name="search_average_cpa_average_cpa" step="0.01" min="0"
                               value="{{ old('search_average_cpa_average_cpa', $campaign->searchStrategies?->search_average_cpa_average_cpa) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_average_cpa_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa_weekly_spend_limit" 
                               name="search_average_cpa_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_average_cpa_weekly_spend_limit', $campaign->searchStrategies?->search_average_cpa_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_average_cpa_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa_bid_ceiling" 
                               name="search_average_cpa_bid_ceiling" step="0.01" min="0"
                               value="{{ old('search_average_cpa_bid_ceiling', $campaign->searchStrategies?->search_average_cpa_bid_ceiling) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_average_cpa_exploration_budget">Минимальный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa_exploration_budget" 
                               name="search_average_cpa_exploration_budget" step="0.01" min="0"
                               value="{{ old('search_average_cpa_exploration_budget', $campaign->searchStrategies?->search_average_cpa_exploration_budget) }}">
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_pay_for_conversion_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_pay_for_conversion_weekly_spend_limit" 
                               name="search_pay_for_conversion_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_pay_for_conversion_weekly_spend_limit', $campaign->searchStrategies?->search_pay_for_conversion_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_pay_for_conversion_cpa">Цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="search_pay_for_conversion_cpa" 
                               name="search_pay_for_conversion_cpa" step="0.01" min="0"
                               value="{{ old('search_pay_for_conversion_cpa', $campaign->searchStrategies?->search_pay_for_conversion_cpa) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Стратегии для сетей -->
        <div id="network_strategy_block" class="mb-4" style="display: none;">
            <h6 class="mb-3">Стратегии для сетей</h6>
            <div class="form-group mb-3">
                <label for="network_strategy_type">Тип стратегии</label>
                <select class="form-select" id="network_strategy_type" name="network_strategy_type">
                    <option value="">Выберите стратегию</option>
                    <option value="WB_MAXIMUM_CLICKS" {{ old('network_strategy_type', $campaign->networkStrategies?->network_strategy_type) == 'WB_MAXIMUM_CLICKS' ? 'selected' : '' }}>Максимум кликов</option>
                    <option value="AVERAGE_CPC" {{ old('network_strategy_type', $campaign->networkStrategies?->network_strategy_type) == 'AVERAGE_CPC' ? 'selected' : '' }}>Максимум кликов по средней цене</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE" {{ old('network_strategy_type', $campaign->networkStrategies?->network_strategy_type) == 'WB_MAXIMUM_CONVERSION_RATE' ? 'selected' : '' }}>Максимум конверсий</option>
                    <option value="AVERAGE_CPA" {{ old('network_strategy_type', $campaign->networkStrategies?->network_strategy_type) == 'AVERAGE_CPA' ? 'selected' : '' }}>Максимум конверсий по средней цене</option>
                    <option value="PAY_FOR_CONVERSION" {{ old('network_strategy_type', $campaign->networkStrategies?->network_strategy_type) == 'PAY_FOR_CONVERSION' ? 'selected' : '' }}>Оплата за конверсии</option>
                </select>
            </div>

            <!-- Параметры стратегии для сетей -->
            <div id="network_strategy_params">
                <!-- WB_MAXIMUM_CLICKS -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CLICKS" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_wb_maximum_clicks_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_wb_maximum_clicks_weekly_spend_limit" 
                               name="network_wb_maximum_clicks_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_wb_maximum_clicks_weekly_spend_limit', $campaign->networkStrategies?->network_wb_maximum_clicks_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_wb_maximum_clicks_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_wb_maximum_clicks_bid_ceiling" 
                               name="network_wb_maximum_clicks_bid_ceiling" step="0.01" min="0"
                               value="{{ old('network_wb_maximum_clicks_bid_ceiling', $campaign->networkStrategies?->network_wb_maximum_clicks_bid_ceiling) }}">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpc_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpc_average_cpc" 
                               name="network_average_cpc_average_cpc" step="0.01" min="0"
                               value="{{ old('network_average_cpc_average_cpc', $campaign->networkStrategies?->network_average_cpc_average_cpc) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_average_cpc_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpc_weekly_spend_limit" 
                               name="network_average_cpc_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_average_cpc_weekly_spend_limit', $campaign->networkStrategies?->network_average_cpc_weekly_spend_limit) }}">
                    </div>
                </div>

                <!-- WB_MAXIMUM_CONVERSION_RATE -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CONVERSION_RATE" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_wb_maximum_conversion_rate_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_wb_maximum_conversion_rate_weekly_spend_limit" 
                               name="network_wb_maximum_conversion_rate_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_wb_maximum_conversion_rate_weekly_spend_limit', $campaign->networkStrategies?->network_wb_maximum_conversion_rate_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_wb_maximum_conversion_rate_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_wb_maximum_conversion_rate_bid_ceiling" 
                               name="network_wb_maximum_conversion_rate_bid_ceiling" step="0.01" min="0"
                               value="{{ old('network_wb_maximum_conversion_rate_bid_ceiling', $campaign->networkStrategies?->network_wb_maximum_conversion_rate_bid_ceiling) }}">
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpa_average_cpa">Средняя цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa_average_cpa" 
                               name="network_average_cpa_average_cpa" step="0.01" min="0"
                               value="{{ old('network_average_cpa_average_cpa', $campaign->networkStrategies?->network_average_cpa_average_cpa) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_average_cpa_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa_weekly_spend_limit" 
                               name="network_average_cpa_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_average_cpa_weekly_spend_limit', $campaign->networkStrategies?->network_average_cpa_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_average_cpa_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa_bid_ceiling" 
                               name="network_average_cpa_bid_ceiling" step="0.01" min="0"
                               value="{{ old('network_average_cpa_bid_ceiling', $campaign->networkStrategies?->network_average_cpa_bid_ceiling) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_average_cpa_exploration_budget">Минимальный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa_exploration_budget" 
                               name="network_average_cpa_exploration_budget" step="0.01" min="0"
                               value="{{ old('network_average_cpa_exploration_budget', $campaign->networkStrategies?->network_average_cpa_exploration_budget) }}">
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_pay_for_conversion_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_pay_for_conversion_weekly_spend_limit" 
                               name="network_pay_for_conversion_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_pay_for_conversion_weekly_spend_limit', $campaign->networkStrategies?->network_pay_for_conversion_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_pay_for_conversion_cpa">Цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="network_pay_for_conversion_cpa" 
                               name="network_pay_for_conversion_cpa" step="0.01" min="0"
                               value="{{ old('network_pay_for_conversion_cpa', $campaign->networkStrategies?->network_pay_for_conversion_cpa) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Цели Яндекс Метрики</h5>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="counter_ids">ID счетчиков Яндекс.Метрики</label>
            <input type="text" class="form-control" id="counter_ids" name="counter_ids[]" 
                   placeholder="Введите ID счетчиков через запятую" 
                   value="{{ old('counter_ids', $campaign->metrics?->counter_ids ? implode(',', (array)$campaign->metrics->counter_ids) : '') }}">
            <small class="form-text text-muted">Введите ID счетчиков через запятую, например: 123456, 789012</small>
        </div>

        <div class="form-group mb-3">
            <label>Цели и их значения</label>
            <div id="goals_container">
                @if(old('priority_goals') || $campaign->metrics?->priority_goals)
                    @foreach(old('priority_goals', $campaign->metrics?->priority_goals ?? []) as $goal)
                        <div class="goal-item mb-3 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">ID цели</label>
                                    <input type="text" class="form-control goal-id" name="priority_goals[][GoalId]" 
                                           value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ценность конверсии (руб.)</label>
                                    <input type="number" class="form-control goal-value" name="priority_goals[][Value]" 
                                           value="{{ $goal['Value'] ?? '' }}" step="0.01" min="0" placeholder="Введите ценность" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Использовать значение из Метрики</label>
                                    <select class="form-control" name="priority_goals[][IsMetrikaSourceOfValue]">
                                        <option value="YES" {{ ($goal['IsMetrikaSourceOfValue'] ?? '') == 'YES' ? 'selected' : '' }}>Да</option>
                                        <option value="NO" {{ ($goal['IsMetrikaSourceOfValue'] ?? '') == 'NO' ? 'selected' : '' }}>Нет</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-outline-danger remove-goal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn btn-outline-primary mt-2" id="add_goal_btn">
                <i class="fas fa-plus"></i> Добавить цель
            </button>
            <div id="goals_validation_message" class="text-danger mt-2" style="display: none;">
                Для выбранной стратегии необходимо указать хотя бы одну цель
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Функция для проверки выбранных платформ
        function checkPlatforms() {
            const searchPlatforms = ['search_result', 'dynamic_places', 'product_gallery', 'search_organization_list'];
            const networkPlatforms = ['network', 'maps'];
            
            const hasSearch = searchPlatforms.some(platform => 
                document.getElementById(platform).checked
            );
            const hasNetwork = networkPlatforms.some(platform => 
                document.getElementById(platform).checked
            );

            // Показываем/скрываем блоки стратегий
            document.getElementById('search_strategy_block').style.display = hasSearch ? 'block' : 'none';
            document.getElementById('network_strategy_block').style.display = hasNetwork ? 'block' : 'none';

            // Если блоки видимы, инициализируем параметры стратегий
            if (hasSearch) {
                const searchStrategyType = document.getElementById('search_strategy_type').value;
                if (searchStrategyType) {
                    updateSearchStrategyParams(searchStrategyType);
                }
            }

            if (hasNetwork) {
                const networkStrategyType = document.getElementById('network_strategy_type').value;
                if (networkStrategyType) {
                    updateNetworkStrategyParams(networkStrategyType);
                }
            }
        }

        // Функция для обновления параметров стратегии поиска
        function updateSearchStrategyParams(strategyType) {
            // Скрываем все блоки параметров
            document.querySelectorAll('#search_strategy_params .strategy-params').forEach(block => {
                block.style.display = 'none';
            });

            // Показываем нужный блок параметров
            if (strategyType) {
                const paramsBlock = document.querySelector(`#search_strategy_params .strategy-params[data-strategy="${strategyType}"]`);
                if (paramsBlock) {
                    paramsBlock.style.display = 'block';
                }
            }
        }

        // Функция для обновления параметров стратегии сетей
        function updateNetworkStrategyParams(strategyType) {
            // Скрываем все блоки параметров
            document.querySelectorAll('#network_strategy_params .strategy-params').forEach(block => {
                block.style.display = 'none';
            });

            // Показываем нужный блок параметров
            if (strategyType) {
                const paramsBlock = document.querySelector(`#network_strategy_params .strategy-params[data-strategy="${strategyType}"]`);
                if (paramsBlock) {
                    paramsBlock.style.display = 'block';
                }
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

        // Обработчик изменения типа стратегии поиска
        document.getElementById('search_strategy_type').addEventListener('change', function() {
            updateSearchStrategyParams(this.value);
            syncGoalsWithStrategy();
        });

        // Обработчик изменения типа стратегии сетей
        document.getElementById('network_strategy_type').addEventListener('change', function() {
            updateNetworkStrategyParams(this.value);
            syncGoalsWithStrategy();
        });

        // Функция для создания элемента цели
        function createGoalElement(goalId = '', value = '', cpa = '') {
            const div = document.createElement('div');
            div.className = 'goal-item mb-3 p-3 border rounded';
            div.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">ID цели</label>
                        <input type="text" class="form-control goal-id" name="priority_goals[][GoalId]" 
                               value="${goalId}" placeholder="Введите ID цели">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ценность конверсии (руб.)</label>
                        <input type="number" class="form-control goal-value" name="priority_goals[][Value]" 
                               value="${value}" step="0.01" min="0" placeholder="Введите ценность">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Цена конверсии (руб.)</label>
                        <input type="number" class="form-control goal-cpa" name="priority_goals[][cpa]" 
                               value="${cpa}" step="0.01" min="0" placeholder="Введите цену">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger remove-goal">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            return div;
        }

        // Функция для обновления видимости поля CPA
        function updateCpaVisibility() {
            const strategyType = document.getElementById('search_strategy_type').value;
            const networkStrategyType = document.getElementById('network_strategy_type').value;
            const isPayForConversion = strategyType === 'PAY_FOR_CONVERSION' || networkStrategyType === 'PAY_FOR_CONVERSION';
            
            document.querySelectorAll('.goal-cpa').forEach(input => {
                const container = input.closest('.col-md-3');
                container.style.display = isPayForConversion ? 'block' : 'none';
                if (isPayForConversion) {
                    input.setAttribute('required', 'required');
                } else {
                    input.removeAttribute('required');
                }
            });
        }

        // Функция для проверки наличия целей при выбранной стратегии
        function validateGoals() {
            const searchStrategyType = document.getElementById('search_strategy_type').value;
            const networkStrategyType = document.getElementById('network_strategy_type').value;
            const requiresGoal = ['WB_MAXIMUM_CONVERSION_RATE', 'AVERAGE_CPA', 'PAY_FOR_CONVERSION'];
            const hasGoals = document.querySelectorAll('.goal-item').length > 0;
            const needsValidation = requiresGoal.includes(searchStrategyType) || requiresGoal.includes(networkStrategyType);
            
            const validationMessage = document.getElementById('goals_validation_message');
            const addGoalBtn = document.getElementById('add_goal_btn');
            
            if (needsValidation && !hasGoals) {
                validationMessage.style.display = 'block';
                addGoalBtn.classList.add('btn-danger');
                addGoalBtn.classList.remove('btn-outline-primary');
            } else {
                validationMessage.style.display = 'none';
                addGoalBtn.classList.remove('btn-danger');
                addGoalBtn.classList.add('btn-outline-primary');
            }
            
            return !needsValidation || hasGoals;
        }

        // Функция для синхронизации целей со стратегиями
        function syncGoalsWithStrategy() {
            const searchStrategyType = document.getElementById('search_strategy_type').value;
            const networkStrategyType = document.getElementById('network_strategy_type').value;
            const requiresGoal = ['WB_MAXIMUM_CONVERSION_RATE', 'AVERAGE_CPA', 'PAY_FOR_CONVERSION'];
            
            // Скрываем все поля goal_id в стратегиях
            document.querySelectorAll('[id$="_goal_id"]').forEach(select => {
                select.closest('.form-group').style.display = 'none';
            });
            
            // Если выбрана стратегия, требующая goal_id, показываем соответствующее поле
            if (requiresGoal.includes(searchStrategyType)) {
                const goalIdField = document.getElementById(`search_${searchStrategyType.toLowerCase()}_goal_id`);
                if (goalIdField) {
                    goalIdField.closest('.form-group').style.display = 'block';
                }
            }
            
            if (requiresGoal.includes(networkStrategyType)) {
                const goalIdField = document.getElementById(`network_${networkStrategyType.toLowerCase()}_goal_id`);
                if (goalIdField) {
                    goalIdField.closest('.form-group').style.display = 'block';
                }
            }
            
            validateGoals();
            updateStrategyGoalIds();
        }

        // Функция для обновления значений goal_id в стратегиях
        function updateStrategyGoalIds() {
            const goals = Array.from(document.querySelectorAll('.goal-item')).map(item => ({
                id: item.querySelector('.goal-id').value,
                value: item.querySelector('.goal-value').value,
                cpa: item.querySelector('.goal-cpa').value
            }));

            // Обновляем значения в селектах стратегий
            document.querySelectorAll('[id$="_goal_id"]').forEach(select => {
                const currentValue = select.value;
                select.innerHTML = '<option value="">Выберите цель</option>';
                
                goals.forEach(goal => {
                    if (goal.id) { // Проверяем, что ID цели не пустой
                        const option = document.createElement('option');
                        option.value = goal.id;
                        option.textContent = `ID: ${goal.id} (Ценность: ${goal.value} руб.)`;
                        option.selected = goal.id === currentValue;
                        select.appendChild(option);
                    }
                });
            });
        }

        // Обработчик добавления цели
        document.getElementById('add_goal_btn').addEventListener('click', function() {
            const container = document.getElementById('goals_container');
            container.appendChild(createGoalElement());
            updateStrategyGoalIds();
            validateGoals();
        });

        // Обработчик удаления цели
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-goal')) {
                const goalItem = e.target.closest('.goal-item');
                goalItem.remove();
                updateStrategyGoalIds();
                validateGoals();
            }
        });

        // Обработчики изменения стратегий
        document.getElementById('search_strategy_type').addEventListener('change', function() {
            updateSearchStrategyParams(this.value);
            syncGoalsWithStrategy();
        });

        document.getElementById('network_strategy_type').addEventListener('change', function() {
            updateNetworkStrategyParams(this.value);
            syncGoalsWithStrategy();
        });

        // Обработчики изменения целей
        document.addEventListener('input', function(e) {
            if (e.target.closest('.goal-item')) {
                updateStrategyGoalIds();
            }
        });

        // Валидация формы перед отправкой
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!validateGoals()) {
                e.preventDefault();
                alert('Для выбранной стратегии необходимо указать хотя бы одну цель');
            }
        });

        // Обработчик добавления новой цели
        document.getElementById('add_goal').addEventListener('click', function() {
            const container = document.getElementById('goals_container');
            const goalItem = document.createElement('div');
            goalItem.className = 'goal-item mb-3 p-3 border rounded';
            goalItem.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">ID цели</label>
                        <input type="text" class="form-control goal-id" name="priority_goals[][GoalId]" 
                               placeholder="Введите ID цели" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ценность конверсии (руб.)</label>
                        <input type="number" class="form-control goal-value" name="priority_goals[][Value]" 
                               step="0.01" min="0" placeholder="Введите ценность" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Использовать значение из Метрики</label>
                        <select class="form-control" name="priority_goals[][IsMetrikaSourceOfValue]">
                            <option value="YES">Да</option>
                            <option value="NO">Нет</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-goal">Удалить</button>
                    </div>
                </div>
            `;
            container.appendChild(goalItem);
        });

        // Обработчик удаления цели
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-goal')) {
                e.target.closest('.goal-item').remove();
            }
        });

        // Обработка счетчиков
        const counterIdsInput = document.getElementById('counter_ids');
        if (counterIdsInput) {
            counterIdsInput.addEventListener('change', function() {
                const value = this.value;
                if (value) {
                    // Преобразуем строку в массив чисел
                    const ids = value.split(',').map(id => parseInt(id.trim())).filter(id => !isNaN(id));
                    // Обновляем значение поля
                    this.value = ids.join(', ');
                }
            });
        }

        // Инициализация при загрузке страницы
        checkPlatforms();
        updateCpaVisibility();
        syncGoalsWithStrategy();
        updateStrategyGoalIds();
    });
</script>
@endpush 