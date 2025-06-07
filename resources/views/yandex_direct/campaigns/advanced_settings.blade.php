@props(['campaign' => null, 'counters' => [], 'goals' => []])

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Места показа</h5>
    </div>
    <div class="card-body">
        <h6 class="mb-3">Поиск</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_placement_types[SearchResults]" 
                   id="search_placement_types_SearchResults" value="YES" 
                   {{ old('search_placement_types.SearchResults', $campaign?->search_placement_types['SearchResults'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="search_placement_types_SearchResults">
                Реклама в поисковой выдаче
                <small class="d-block text-muted">Разместите свои объявления в специальных рекламных блоках на страницах результатов поиска</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_placement_types[DynamicPlaces]" 
                   id="search_placement_types_DynamicPlaces" value="YES" 
                   {{ old('search_placement_types.DynamicPlaces', $campaign?->search_placement_types['DynamicPlaces'] ?? '') == 'YES' ? 'checked' : '' }}
                   data-requires="search_placement_types_SearchResults">
            <label class="form-check-label" for="search_placement_types_DynamicPlaces">
                Динамические места на поиске
                <small class="d-block text-muted">Получайте дополнительные конверсии, повышая видимость своих страниц в поиске по товарам и услугам</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_placement_types[ProductGallery]" 
                   id="search_placement_types_ProductGallery" value="YES" 
                   {{ old('search_placement_types.ProductGallery', $campaign?->search_placement_types['ProductGallery'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="search_placement_types_ProductGallery">
                Товарная галерея на поиске
                <small class="d-block text-muted">Покажите свои предложения в карусели товаров из разных магазинов, которая появляется над результатами поиска</small>
            </label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_placement_types[SearchOrganizationList]" 
                   id="search_placement_types_SearchOrganizationList" value="YES" 
                   {{ old('search_placement_types.SearchOrganizationList', $campaign?->search_placement_types['SearchOrganizationList'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="search_placement_types_SearchOrganizationList">
                Список организаций в результатах поиска
                <small class="d-block text-muted">Станьте заметнее среди других организаций из Яндекс Бизнеса, которые появляются над результатами поиска</small>
            </label>
        </div>

        <h6 class="mb-3">Сети</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="network_placement_types[Network]" 
                   id="network_placement_types_Network" value="YES" 
                   {{ old('network_placement_types.Network', $campaign?->network_placement_types['Network'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="network_placement_types_Network">
                Рекламная сеть Яндекса
                <small class="d-block text-muted">Охватите посетителей десятков тысяч сайтов и приложений, которым могут быть интересны ваши товары и услуги</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="network_placement_types[Maps]" 
                   id="network_placement_types_Maps" value="YES" 
                   {{ old('network_placement_types.Maps', $campaign?->network_placement_types['Maps'] ?? '') == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="network_placement_types_Maps">
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
                <label for="search_bidding_strategy_type">Тип стратегии</label>
                <select class="form-select" id="search_bidding_strategy_type" name="search_bidding_strategy_type">
                    <option value="">Выберите стратегию</option>
                    <option value="HIGHEST_POSITION">Максимум кликов с ручными ставками</option>
                    <option value="WB_MAXIMUM_CLICKS">Максимум кликов</option>
                    <option value="AVERAGE_CPC">Максимум кликов по средней цене</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE">Максимум конверсий</option>
                    <option value="AVERAGE_CPA">Максимум конверсий по средней цене</option>
                    <option value="PAY_FOR_CONVERSION">Оплата за конверсии</option>
                </select>
            </div>

            <!-- Параметры стратегии для поиска -->
            <div id="search_strategy_params">
                <!-- HIGHEST_POSITION -->
                <div class="strategy-params" data-strategy="HIGHEST_POSITION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_daily_budget">Дневной бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_daily_budget" name="search_bidding_strategy[DailyBudget][Amount]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_daily_budget_mode">Режим дневного бюджета</label>
                        <select class="form-select" id="search_daily_budget_mode" name="search_bidding_strategy[DailyBudget][Mode]">
                            <option value="STANDARD">Стандартный</option>
                            <option value="EXTENDED">Расширенный</option>
                        </select>
                    </div>
                </div>

                <!-- WB_MAXIMUM_CLICKS -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CLICKS" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_bidding_strategy_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_bidding_strategy_weekly_spend_limit" name="search_bidding_strategy[WeeklySpendLimit]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_bid_ceiling" name="search_bidding_strategy[BidCeiling]" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpc" name="search_bidding_strategy[AverageCpc]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_bidding_strategy_weekly_spend_limit_cpc">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_bidding_strategy_weekly_spend_limit_cpc" name="search_bidding_strategy[WeeklySpendLimitCpc]" step="0.01" min="0">
                    </div>
                </div>

                <!-- WB_MAXIMUM_CONVERSION_RATE -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CONVERSION_RATE" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_bidding_strategy_weekly_spend_limit_conv">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_bidding_strategy_weekly_spend_limit_conv" name="search_bidding_strategy[WeeklySpendLimitConv]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_bid_ceiling_conv">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_bid_ceiling_conv" name="search_bidding_strategy[BidCeilingConv]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_goal_id_conv">ID цели</label>
                        <select class="form-select" id="search_goal_id_conv" name="search_bidding_strategy[GoalIdConv]">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpa">Средняя цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa" name="search_bidding_strategy[AverageCpa]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_bidding_strategy_weekly_spend_limit_cpa">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_bidding_strategy_weekly_spend_limit_cpa" name="search_bidding_strategy[WeeklySpendLimitCpa]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_bid_ceiling_cpa">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_bid_ceiling_cpa" name="search_bidding_strategy[BidCeilingCpa]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_exploration_budget">Минимальный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_exploration_budget" name="search_bidding_strategy[ExplorationBudget]" step="0.01" min="0">
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_bidding_strategy_weekly_spend_limit_pfc">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_bidding_strategy_weekly_spend_limit_pfc" name="search_bidding_strategy[WeeklySpendLimitPfc]" step="0.01" min="0">
                    </div>
                </div>
            </div>
        </div>

        <!-- Стратегии для сетей -->
        <div id="network_strategy_block" class="mb-4" style="display: none;">
            <h6 class="mb-3">Стратегии для сетей</h6>
            <div class="form-group mb-3">
                <label for="network_bidding_strategy_type">Тип стратегии</label>
                <select class="form-select" id="network_bidding_strategy_type" name="network_bidding_strategy_type">
                    <option value="">Выберите стратегию</option>
                    <option value="WB_MAXIMUM_CLICKS">Максимум кликов</option>
                    <option value="AVERAGE_CPC">Максимум кликов по средней цене</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE">Максимум конверсий</option>
                    <option value="AVERAGE_CPA">Максимум конверсий по средней цене</option>
                    <option value="PAY_FOR_CONVERSION">Оплата за конверсии</option>
                </select>
            </div>

            <!-- Параметры стратегии для сетей -->
            <div id="network_strategy_params">
                <!-- WB_MAXIMUM_CLICKS -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CLICKS" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_bidding_strategy_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_bidding_strategy_weekly_spend_limit" name="network_bidding_strategy[WeeklySpendLimit]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_bid_ceiling" name="network_bidding_strategy[BidCeiling]" step="0.01" min="0">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpc" name="network_bidding_strategy[AverageCpc]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_bidding_strategy_weekly_spend_limit_cpc">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_bidding_strategy_weekly_spend_limit_cpc" name="network_bidding_strategy[WeeklySpendLimitCpc]" step="0.01" min="0">
                    </div>
                </div>

                <!-- WB_MAXIMUM_CONVERSION_RATE -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CONVERSION_RATE" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_bidding_strategy_weekly_spend_limit_conv">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_bidding_strategy_weekly_spend_limit_conv" name="network_bidding_strategy[WeeklySpendLimitConv]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_bid_ceiling_conv">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_bid_ceiling_conv" name="network_bidding_strategy[BidCeilingConv]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_goal_id_conv">ID цели</label>
                        <select class="form-select" id="network_goal_id_conv" name="network_bidding_strategy[GoalIdConv]">
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpa">Средняя цена конверсии (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa" name="network_bidding_strategy[AverageCpa]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_bidding_strategy_weekly_spend_limit_cpa">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_bidding_strategy_weekly_spend_limit_cpa" name="network_bidding_strategy[WeeklySpendLimitCpa]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_bid_ceiling_cpa">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_bid_ceiling_cpa" name="network_bidding_strategy[BidCeilingCpa]" step="0.01" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_exploration_budget">Минимальный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_exploration_budget" name="network_bidding_strategy[ExplorationBudget]" step="0.01" min="0">
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_bidding_strategy_weekly_spend_limit_pfc">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_bidding_strategy_weekly_spend_limit_pfc" name="network_bidding_strategy[WeeklySpendLimitPfc]" step="0.01" min="0">
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
            <input type="text" class="form-control" id="counter_ids" name="counter_ids" 
                   placeholder="Введите ID счетчиков через запятую" 
                   value="{{ old('counter_ids', $campaign?->counter_ids ? implode(',', (array)$campaign->counter_ids) : '') }}">
            <small class="form-text text-muted">Введите ID счетчиков через запятую, например: 123456, 789012</small>
        </div>

        <div class="form-group mb-3">
            <label>Цели и их значения</label>
            <div id="goals_container">
                <!-- Здесь будут добавляться цели -->
            </div>
            <button type="button" class="btn btn-outline-primary mt-2" id="add_goal_btn">
                <i class="fas fa-plus"></i> Добавить цель
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Функция для проверки выбранных платформ
        function checkPlatforms() {
            const searchPlatforms = ['SearchResults', 'DynamicPlaces', 'ProductGallery', 'SearchOrganizationList'];
            const networkPlatforms = ['Network', 'Maps'];
            
            const hasSearch = searchPlatforms.some(platform => 
                document.getElementById(`search_placement_types_${platform}`).checked
            );
            const hasNetwork = networkPlatforms.some(platform => 
                document.getElementById(`network_placement_types_${platform}`).checked
            );

            // Показываем/скрываем блоки стратегий
            document.getElementById('search_strategy_block').style.display = hasSearch ? 'block' : 'none';
            document.getElementById('network_strategy_block').style.display = hasNetwork ? 'block' : 'none';
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
        document.getElementById('search_bidding_strategy_type').addEventListener('change', function() {
            updateSearchStrategyParams(this.value);
        });

        // Обработчик изменения типа стратегии сетей
        document.getElementById('network_bidding_strategy_type').addEventListener('change', function() {
            updateNetworkStrategyParams(this.value);
        });

        // Функция для создания элемента цели
        function createGoalElement(goalId = '', value = '', cpa = '') {
            const div = document.createElement('div');
            div.className = 'goal-item mb-3 p-3 border rounded';
            div.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">ID цели</label>
                        <input type="text" class="form-control goal-id" name="goals[][id]" 
                               value="${goalId}" placeholder="Введите ID цели">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Ценность конверсии (руб.)</label>
                        <input type="number" class="form-control goal-value" name="goals[][value]" 
                               value="${value}" step="0.01" min="0" placeholder="Введите ценность">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Цена конверсии (руб.)</label>
                        <input type="number" class="form-control goal-cpa" name="goals[][cpa]" 
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
            const strategyType = document.getElementById('search_bidding_strategy_type').value;
            const networkStrategyType = document.getElementById('network_bidding_strategy_type').value;
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

        // Обработчик добавления цели
        document.getElementById('add_goal_btn').addEventListener('click', function() {
            const container = document.getElementById('goals_container');
            container.appendChild(createGoalElement());
            updateCpaVisibility();
        });

        // Обработчик удаления цели
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-goal')) {
                e.target.closest('.goal-item').remove();
            }
        });

        // Обработчики изменения стратегий
        document.getElementById('search_bidding_strategy_type').addEventListener('change', updateCpaVisibility);
        document.getElementById('network_bidding_strategy_type').addEventListener('change', updateCpaVisibility);

        // Функция для переноса значений из стратегий в цели
        function syncGoalsWithStrategy() {
            const searchStrategyType = document.getElementById('search_bidding_strategy_type').value;
            const networkStrategyType = document.getElementById('network_bidding_strategy_type').value;
            const container = document.getElementById('goals_container');
            
            // Очищаем контейнер целей
            container.innerHTML = '';

            // Проверяем стратегии поиска
            if (['WB_MAXIMUM_CONVERSION_RATE'].includes(searchStrategyType)) {
                const goalId = document.getElementById('search_goal_id_conv')?.value;
                
                if (goalId) {
                    container.appendChild(createGoalElement(goalId, '', ''));
                }
            }

            // Проверяем стратегии сетей
            if (['WB_MAXIMUM_CONVERSION_RATE'].includes(networkStrategyType)) {
                const goalId = document.getElementById('network_goal_id_conv')?.value;
                
                if (goalId) {
                    container.appendChild(createGoalElement(goalId, '', ''));
                }
            }

            updateCpaVisibility();
        }

        // Добавляем обработчики для синхронизации целей
        document.getElementById('search_bidding_strategy_type').addEventListener('change', syncGoalsWithStrategy);
        document.getElementById('network_bidding_strategy_type').addEventListener('change', syncGoalsWithStrategy);

        // Инициализация при загрузке страницы
        checkPlatforms();
        const searchStrategyType = document.getElementById('search_bidding_strategy_type').value;
        const networkStrategyType = document.getElementById('network_bidding_strategy_type').value;
        
        if (searchStrategyType) {
            updateSearchStrategyParams(searchStrategyType);
        }
        if (networkStrategyType) {
            updateNetworkStrategyParams(networkStrategyType);
        }
        updateCpaVisibility();
        syncGoalsWithStrategy();
    });
</script>
@endpush 