@props(['searchStrategies' => null])

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Стратегии для поиска</h5>
    </div>
    <div class="card-body">
        <div id="search_strategy_block" class="mb-4" style="display: none;">
            <div class="form-group mb-3">
                <label for="search_strategy_type">Тип стратегии</label>
                <select class="form-select" id="search_strategy_type" name="search_strategy_type">
                    <option value="">Выберите стратегию</option>
                    <option value="HIGHEST_POSITION" {{ old('search_strategy_type', $searchStrategies->first()?->search_strategy_type) == 'HIGHEST_POSITION' ? 'selected' : '' }}>Максимум кликов с ручными ставками</option>
                    <option value="WB_MAXIMUM_CLICKS" {{ old('search_strategy_type', $searchStrategies->first()?->search_strategy_type) == 'WB_MAXIMUM_CLICKS' ? 'selected' : '' }}>Максимум кликов</option>
                    <option value="AVERAGE_CPC" {{ old('search_strategy_type', $searchStrategies->first()?->search_strategy_type) == 'AVERAGE_CPC' ? 'selected' : '' }}>Максимум кликов по средней цене</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE" {{ old('search_strategy_type', $searchStrategies->first()?->search_strategy_type) == 'WB_MAXIMUM_CONVERSION_RATE' ? 'selected' : '' }}>Максимум конверсий</option>
                    <option value="AVERAGE_CPA" {{ old('search_strategy_type', $searchStrategies->first()?->search_strategy_type) == 'AVERAGE_CPA' ? 'selected' : '' }}>Максимум конверсий по средней цене</option>
                    <option value="PAY_FOR_CONVERSION" {{ old('search_strategy_type', $searchStrategies->first()?->search_strategy_type) == 'PAY_FOR_CONVERSION' ? 'selected' : '' }}>Оплата за конверсии</option>
                </select>
            </div>

            <!-- Параметры стратегии для поиска -->
            <div id="search_strategy_params">
                <!-- HIGHEST_POSITION -->
                <div class="strategy-params" data-strategy="HIGHEST_POSITION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_daily_budget">Дневной бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_daily_budget" name="daily_budget_amount" step="0.01" min="0" value="{{ old('daily_budget_amount', $searchStrategies->first()?->daily_budget_amount) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_daily_budget_mode">Режим дневного бюджета</label>
                        <select class="form-select" id="search_daily_budget_mode" name="daily_budget_mode">
                            <option value="STANDARD" @selected(old('daily_budget_mode', $searchStrategies->first()?->daily_budget_mode) == 'STANDARD')>Стандартный</option>
                            <option value="DISTRIBUTED" @selected(old('daily_budget_mode', $searchStrategies->first()?->daily_budget_mode) == 'DISTRIBUTED')>Распределенный</option>
                        </select>
                    </div>
                </div>

                <!-- WB_MAXIMUM_CLICKS -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CLICKS" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_clicks_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_clicks_weekly_spend_limit" 
                               name="search_wb_maximum_clicks_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_clicks_weekly_spend_limit', $searchStrategies->first()?->search_wb_maximum_clicks_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_clicks_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_clicks_bid_ceiling" 
                               name="search_wb_maximum_clicks_bid_ceiling" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_clicks_bid_ceiling', $searchStrategies->first()?->search_wb_maximum_clicks_bid_ceiling) }}">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpc_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpc_average_cpc" 
                               name="search_average_cpc_average_cpc" step="0.01" min="0"
                               value="{{ old('search_average_cpc_average_cpc', $searchStrategies->first()?->search_average_cpc_average_cpc) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_average_cpc_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpc_weekly_spend_limit" 
                               name="search_average_cpc_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_average_cpc_weekly_spend_limit', $searchStrategies->first()?->search_average_cpc_weekly_spend_limit) }}">
                    </div>
                </div>

                <!-- WB_MAXIMUM_CONVERSION_RATE -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CONVERSION_RATE" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_conversion_rate_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_conversion_rate_weekly_spend_limit" 
                               name="search_wb_maximum_conversion_rate_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_conversion_rate_weekly_spend_limit', $searchStrategies->first()?->search_wb_maximum_conversion_rate_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_wb_maximum_conversion_rate_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_wb_maximum_conversion_rate_bid_ceiling" 
                               name="search_wb_maximum_conversion_rate_bid_ceiling" step="0.01" min="0"
                               value="{{ old('search_wb_maximum_conversion_rate_bid_ceiling', $searchStrategies->first()?->search_wb_maximum_conversion_rate_bid_ceiling) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Цели и их значения</label>
                        <div id="search_conversion_goals_container">
                            @if(old('search_conversion_goals') || $searchStrategies->first()?->conversion_goals)
                                @foreach(old('search_conversion_goals', $searchStrategies->first()?->conversion_goals ?? []) as $goal)
                                    <div class="goal-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="form-label">ID цели</label>
                                                <input type="text" class="form-control goal-id" name="search_conversion_goals[][GoalId]" 
                                                       value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Ценность конверсии (руб.)</label>
                                                <input type="number" class="form-control goal-value" name="search_conversion_goals[][Value]" 
                                                       value="{{ $goal['Value'] ?? '' }}" step="0.01" min="0" placeholder="Введите ценность" required>
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
                        <button type="button" class="btn btn-outline-primary mt-2" id="add_search_conversion_goal_btn">
                            <i class="fas fa-plus"></i> Добавить цель
                        </button>
                        <div id="search_conversion_goals_validation_message" class="text-danger mt-2" style="display: none;">
                            Для выбранной стратегии необходимо указать хотя бы одну цель
                        </div>
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_average_cpa_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa_weekly_spend_limit" 
                               name="search_average_cpa_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_average_cpa_weekly_spend_limit', $searchStrategies->first()?->search_average_cpa_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_average_cpa_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa_bid_ceiling" 
                               name="search_average_cpa_bid_ceiling" step="0.01" min="0"
                               value="{{ old('search_average_cpa_bid_ceiling', $searchStrategies->first()?->search_average_cpa_bid_ceiling) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_average_cpa_exploration_budget">Минимальный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_average_cpa_exploration_budget" 
                               name="search_average_cpa_exploration_budget" step="0.01" min="0"
                               value="{{ old('search_average_cpa_exploration_budget', $searchStrategies->first()?->search_average_cpa_exploration_budget) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Цели и их значения</label>
                        <div id="search_cpa_goals_container">
                            @if(old('search_cpa_goals') || $searchStrategies->first()?->conversion_goals)
                                @foreach(old('search_cpa_goals', $searchStrategies->first()?->conversion_goals ?? []) as $goal)
                                    <div class="goal-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="form-label">ID цели</label>
                                                <input type="text" class="form-control goal-id" name="search_cpa_goals[][GoalId]" 
                                                       value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Средняя цена конверсии (руб.)</label>
                                                <input type="number" class="form-control goal-value" name="search_cpa_goals[][AverageCpa]" 
                                                       value="{{ $goal['AverageCpa'] ?? '' }}" step="0.01" min="0" placeholder="Введите цену" required>
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
                        <button type="button" class="btn btn-outline-primary mt-2" id="add_search_cpa_goal_btn">
                            <i class="fas fa-plus"></i> Добавить цель
                        </button>
                        <div id="search_cpa_goals_validation_message" class="text-danger mt-2" style="display: none;">
                            Для выбранной стратегии необходимо указать хотя бы одну цель
                        </div>
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="search_pay_for_conversion_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="search_pay_for_conversion_weekly_spend_limit" 
                               name="search_pay_for_conversion_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('search_pay_for_conversion_weekly_spend_limit', $searchStrategies->first()?->search_pay_for_conversion_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Цели и их значения</label>
                        <div id="search_pay_for_conversion_goals_container">
                            @if(old('search_pay_for_conversion_goals') || $searchStrategies->first()?->conversion_goals)
                                @foreach(old('search_pay_for_conversion_goals', $searchStrategies->first()?->conversion_goals ?? []) as $goal)
                                    <div class="goal-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="form-label">ID цели</label>
                                                <input type="text" class="form-control goal-id" name="search_pay_for_conversion_goals[][GoalId]" 
                                                       value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Цена конверсии (руб.)</label>
                                                <input type="number" class="form-control goal-value" name="search_pay_for_conversion_goals[][ConversionPrice]" 
                                                       value="{{ $goal['ConversionPrice'] ?? '' }}" step="0.01" min="0" placeholder="Введите цену" required>
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
                        <button type="button" class="btn btn-outline-primary mt-2" id="add_search_pay_for_conversion_goal_btn">
                            <i class="fas fa-plus"></i> Добавить цель
                        </button>
                        <div id="search_pay_for_conversion_goals_validation_message" class="text-danger mt-2" style="display: none;">
                            Для выбранной стратегии необходимо указать хотя бы одну цель
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Функция для создания элемента цели
    function createSearchGoalElement(containerId, namePrefix, valueField = 'Value', valueLabel = 'Ценность конверсии') {
        const div = document.createElement('div');
        div.className = 'goal-item mb-3 p-3 border rounded';
        div.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <label class="form-label">ID цели</label>
                    <input type="text" class="form-control goal-id" name="${namePrefix}[][GoalId]" 
                           placeholder="Введите ID цели" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">${valueLabel} (руб.)</label>
                    <input type="number" class="form-control goal-value" name="${namePrefix}[][${valueField}]" 
                           step="0.01" min="0" placeholder="Введите цену" required>
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

    // Функция для проверки наличия целей
    function validateSearchGoals(strategyType) {
        const requiresGoals = ['WB_MAXIMUM_CONVERSION_RATE', 'AVERAGE_CPA', 'PAY_FOR_CONVERSION'];
        if (!requiresGoals.includes(strategyType)) return true;

        let containerId, validationMessageId;
        switch(strategyType) {
            case 'WB_MAXIMUM_CONVERSION_RATE':
                containerId = 'search_conversion_goals_container';
                validationMessageId = 'search_conversion_goals_validation_message';
                break;
            case 'AVERAGE_CPA':
                containerId = 'search_cpa_goals_container';
                validationMessageId = 'search_cpa_goals_validation_message';
                break;
            case 'PAY_FOR_CONVERSION':
                containerId = 'search_pay_for_conversion_goals_container';
                validationMessageId = 'search_pay_for_conversion_goals_validation_message';
                break;
        }

        const container = document.getElementById(containerId);
        const validationMessage = document.getElementById(validationMessageId);
        const goals = container.querySelectorAll('.goal-item');
        const hasGoals = goals.length > 0;

        if (!hasGoals) {
            validationMessage.style.display = 'block';
            return false;
        }

        validationMessage.style.display = 'none';
        return true;
    }

    // Функция для обновления параметров стратегии поиска
    function updateSearchStrategyParams() {
        const strategyType = document.getElementById('search_strategy_type').value;
        const strategyParams = document.querySelectorAll('#search_strategy_block .strategy-params');
        
        strategyParams.forEach(param => {
            if (param.dataset.strategy === strategyType) {
                param.style.display = 'block';
            } else {
                param.style.display = 'none';
            }
        });

        // Валидируем цели
        validateSearchGoals(strategyType);
    }

    // Обработчики добавления целей
    document.getElementById('add_search_conversion_goal_btn')?.addEventListener('click', function() {
        const container = document.getElementById('search_conversion_goals_container');
        container.appendChild(createSearchGoalElement('search_conversion_goals', 'Value', 'Ценность конверсии'));
        validateSearchGoals('WB_MAXIMUM_CONVERSION_RATE');
    });

    document.getElementById('add_search_cpa_goal_btn')?.addEventListener('click', function() {
        const container = document.getElementById('search_cpa_goals_container');
        container.appendChild(createSearchGoalElement('search_cpa_goals', 'AverageCpa', 'Средняя цена конверсии'));
        validateSearchGoals('AVERAGE_CPA');
    });

    document.getElementById('add_search_pay_for_conversion_goal_btn')?.addEventListener('click', function() {
        const container = document.getElementById('search_pay_for_conversion_goals_container');
        container.appendChild(createSearchGoalElement('search_pay_for_conversion_goals', 'ConversionPrice', 'Цена конверсии'));
        validateSearchGoals('PAY_FOR_CONVERSION');
    });

    // Обработчик удаления цели
    document.querySelectorAll('#search_strategy_block .remove-goal').forEach(button => {
        button.addEventListener('click', function() {
            const goalItem = this.closest('.goal-item');
            const strategyType = document.getElementById('search_strategy_type').value;
            goalItem.remove();
            validateSearchGoals(strategyType);
        });
    });

    // Обработчик изменения типа стратегии поиска
    document.getElementById('search_strategy_type')?.addEventListener('change', updateSearchStrategyParams);

    // Валидация формы перед отправкой
    document.querySelector('form').addEventListener('submit', function(e) {
        const strategyType = document.getElementById('search_strategy_type').value;
        if (!validateSearchGoals(strategyType)) {
            e.preventDefault();
            alert('Для выбранной стратегии необходимо указать хотя бы одну цель');
        }
    });

    // Инициализация при загрузке страницы
    updateSearchStrategyParams();
});
</script>
@endpush 