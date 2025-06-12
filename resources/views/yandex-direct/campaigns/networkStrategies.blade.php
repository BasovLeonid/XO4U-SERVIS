@props(['networkStrategies' => null])

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Стратегии для сетей</h5>
    </div>
    <div class="card-body">
        <div id="network_strategy_block" class="mb-4" style="display: none;">
            <div class="form-group mb-3">
                <label for="network_strategy_type">Тип стратегии</label>
                <select class="form-select" id="network_strategy_type" name="network_strategy_type">
                    <option value="">Выберите стратегию</option>
                    <option value="WB_MAXIMUM_CLICKS" {{ old('network_strategy_type', $networkStrategies->first()?->network_strategy_type) == 'WB_MAXIMUM_CLICKS' ? 'selected' : '' }}>Максимум кликов</option>
                    <option value="AVERAGE_CPC" {{ old('network_strategy_type', $networkStrategies->first()?->network_strategy_type) == 'AVERAGE_CPC' ? 'selected' : '' }}>Максимум кликов по средней цене</option>
                    <option value="WB_MAXIMUM_CONVERSION_RATE" {{ old('network_strategy_type', $networkStrategies->first()?->network_strategy_type) == 'WB_MAXIMUM_CONVERSION_RATE' ? 'selected' : '' }}>Максимум конверсий</option>
                    <option value="AVERAGE_CPA" {{ old('network_strategy_type', $networkStrategies->first()?->network_strategy_type) == 'AVERAGE_CPA' ? 'selected' : '' }}>Максимум конверсий по средней цене</option>
                    <option value="PAY_FOR_CONVERSION" {{ old('network_strategy_type', $networkStrategies->first()?->network_strategy_type) == 'PAY_FOR_CONVERSION' ? 'selected' : '' }}>Оплата за конверсии</option>
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
                               value="{{ old('network_wb_maximum_clicks_weekly_spend_limit', $networkStrategies->first()?->network_wb_maximum_clicks_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_wb_maximum_clicks_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_wb_maximum_clicks_bid_ceiling" 
                               name="network_wb_maximum_clicks_bid_ceiling" step="0.01" min="0"
                               value="{{ old('network_wb_maximum_clicks_bid_ceiling', $networkStrategies->first()?->network_wb_maximum_clicks_bid_ceiling) }}">
                    </div>
                </div>

                <!-- AVERAGE_CPC -->
                <div class="strategy-params" data-strategy="AVERAGE_CPC" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpc_average_cpc">Средняя цена клика (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpc_average_cpc" 
                               name="network_average_cpc_average_cpc" step="0.01" min="0"
                               value="{{ old('network_average_cpc_average_cpc', $networkStrategies->first()?->network_average_cpc_average_cpc) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_average_cpc_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpc_weekly_spend_limit" 
                               name="network_average_cpc_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_average_cpc_weekly_spend_limit', $networkStrategies->first()?->network_average_cpc_weekly_spend_limit) }}">
                    </div>
                </div>

                <!-- WB_MAXIMUM_CONVERSION_RATE -->
                <div class="strategy-params" data-strategy="WB_MAXIMUM_CONVERSION_RATE" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_wb_maximum_conversion_rate_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_wb_maximum_conversion_rate_weekly_spend_limit" 
                               name="network_wb_maximum_conversion_rate_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_wb_maximum_conversion_rate_weekly_spend_limit', $networkStrategies->first()?->network_wb_maximum_conversion_rate_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_wb_maximum_conversion_rate_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_wb_maximum_conversion_rate_bid_ceiling" 
                               name="network_wb_maximum_conversion_rate_bid_ceiling" step="0.01" min="0"
                               value="{{ old('network_wb_maximum_conversion_rate_bid_ceiling', $networkStrategies->first()?->network_wb_maximum_conversion_rate_bid_ceiling) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Цели и их значения</label>
                        <div id="network_conversion_goals_container">
                            @if(old('network_conversion_goals') || $networkStrategies->first()?->conversion_goals)
                                @foreach(old('network_conversion_goals', $networkStrategies->first()?->conversion_goals ?? []) as $goal)
                                    <div class="goal-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="form-label">ID цели</label>
                                                <input type="text" class="form-control goal-id" name="network_conversion_goals[][GoalId]" 
                                                       value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Ценность конверсии (руб.)</label>
                                                <input type="number" class="form-control goal-value" name="network_conversion_goals[][Value]" 
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
                        <button type="button" class="btn btn-outline-primary mt-2" id="add_network_conversion_goal_btn">
                            <i class="fas fa-plus"></i> Добавить цель
                        </button>
                        <div id="network_conversion_goals_validation_message" class="text-danger mt-2" style="display: none;">
                            Для выбранной стратегии необходимо указать хотя бы одну цель
                        </div>
                    </div>
                </div>

                <!-- AVERAGE_CPA -->
                <div class="strategy-params" data-strategy="AVERAGE_CPA" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_average_cpa_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa_weekly_spend_limit" 
                               name="network_average_cpa_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_average_cpa_weekly_spend_limit', $networkStrategies->first()?->network_average_cpa_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_average_cpa_bid_ceiling">Максимальная ставка (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa_bid_ceiling" 
                               name="network_average_cpa_bid_ceiling" step="0.01" min="0"
                               value="{{ old('network_average_cpa_bid_ceiling', $networkStrategies->first()?->network_average_cpa_bid_ceiling) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="network_average_cpa_exploration_budget">Минимальный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_average_cpa_exploration_budget" 
                               name="network_average_cpa_exploration_budget" step="0.01" min="0"
                               value="{{ old('network_average_cpa_exploration_budget', $networkStrategies->first()?->network_average_cpa_exploration_budget) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Цели и их значения</label>
                        <div id="network_cpa_goals_container">
                            @if(old('network_cpa_goals') || $networkStrategies->first()?->conversion_goals)
                                @foreach(old('network_cpa_goals', $networkStrategies->first()?->conversion_goals ?? []) as $goal)
                                    <div class="goal-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="form-label">ID цели</label>
                                                <input type="text" class="form-control goal-id" name="network_cpa_goals[][GoalId]" 
                                                       value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Средняя цена конверсии (руб.)</label>
                                                <input type="number" class="form-control goal-value" name="network_cpa_goals[][AverageCpa]" 
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
                        <button type="button" class="btn btn-outline-primary mt-2" id="add_network_cpa_goal_btn">
                            <i class="fas fa-plus"></i> Добавить цель
                        </button>
                        <div id="network_cpa_goals_validation_message" class="text-danger mt-2" style="display: none;">
                            Для выбранной стратегии необходимо указать хотя бы одну цель
                        </div>
                    </div>
                </div>

                <!-- PAY_FOR_CONVERSION -->
                <div class="strategy-params" data-strategy="PAY_FOR_CONVERSION" style="display: none;">
                    <div class="form-group mb-3">
                        <label for="network_pay_for_conversion_weekly_spend_limit">Недельный бюджет (руб.)</label>
                        <input type="number" class="form-control" id="network_pay_for_conversion_weekly_spend_limit" 
                               name="network_pay_for_conversion_weekly_spend_limit" step="0.01" min="0"
                               value="{{ old('network_pay_for_conversion_weekly_spend_limit', $networkStrategies->first()?->network_pay_for_conversion_weekly_spend_limit) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Цели и их значения</label>
                        <div id="network_pay_for_conversion_goals_container">
                            @if(old('network_pay_for_conversion_goals') || $networkStrategies->first()?->conversion_goals)
                                @foreach(old('network_pay_for_conversion_goals', $networkStrategies->first()?->conversion_goals ?? []) as $goal)
                                    <div class="goal-item mb-3 p-3 border rounded">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label class="form-label">ID цели</label>
                                                <input type="text" class="form-control goal-id" name="network_pay_for_conversion_goals[][GoalId]" 
                                                       value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Цена конверсии (руб.)</label>
                                                <input type="number" class="form-control goal-value" name="network_pay_for_conversion_goals[][ConversionPrice]" 
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
                        <button type="button" class="btn btn-outline-primary mt-2" id="add_network_pay_for_conversion_goal_btn">
                            <i class="fas fa-plus"></i> Добавить цель
                        </button>
                        <div id="network_pay_for_conversion_goals_validation_message" class="text-danger mt-2" style="display: none;">
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
    function createGoalElement(containerId, namePrefix, valueField = 'Value', valueLabel = 'Ценность конверсии') {
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

    // Функция для обновления отображаемых параметров стратегии
    function updateStrategyParams() {
        const strategyType = document.getElementById('network_strategy_type').value;
        const strategyParams = document.querySelectorAll('#network_strategy_block .strategy-params');
        
        strategyParams.forEach(param => {
            if (param.dataset.strategy === strategyType) {
                param.style.display = 'block';
            } else {
                param.style.display = 'none';
            }
        });

        // Вызываем валидацию целей
        if (typeof validateGoals === 'function') {
            validateGoals(strategyType);
        }
    }

    // Функция для проверки наличия целей
    function validateGoals(strategyType) {
        const requiresGoals = ['WB_MAXIMUM_CONVERSION_RATE', 'AVERAGE_CPA', 'PAY_FOR_CONVERSION'];
        if (!requiresGoals.includes(strategyType)) return true;

        let containerId, validationMessageId;
        switch (strategyType) {
            case 'WB_MAXIMUM_CONVERSION_RATE':
                containerId = 'network_conversion_goals_container';
                validationMessageId = 'network_conversion_goals_validation_message';
                break;
            case 'AVERAGE_CPA':
                containerId = 'network_cpa_goals_container';
                validationMessageId = 'network_cpa_goals_validation_message';
                break;
            case 'PAY_FOR_CONVERSION':
                containerId = 'network_pay_for_conversion_goals_container';
                validationMessageId = 'network_pay_for_conversion_goals_validation_message';
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

    // Обработчик изменения типа стратегии
    document.getElementById('network_strategy_type')?.addEventListener('change', updateStrategyParams);

    // Обработчики удаления целей
    document.querySelectorAll('#network_strategy_block .remove-goal').forEach(button => {
        button.addEventListener('click', function() {
            const goalItem = this.closest('.goal-item');
            const container = goalItem.parentElement;
            goalItem.remove();
            
            const strategyType = document.getElementById('network_strategy_type').value;
            validateGoals(strategyType);
        });
    });

    // Обработчики добавления целей
    document.getElementById('add_network_conversion_goal_btn')?.addEventListener('click', function() {
        const container = document.getElementById('network_conversion_goals_container');
        container.appendChild(createGoalElement('network_conversion_goals', 'Value', 'Ценность конверсии'));
        validateGoals('WB_MAXIMUM_CONVERSION_RATE');
    });

    document.getElementById('add_network_cpa_goal_btn')?.addEventListener('click', function() {
        const container = document.getElementById('network_cpa_goals_container');
        container.appendChild(createGoalElement('network_cpa_goals', 'AverageCpa', 'Средняя цена конверсии'));
        validateGoals('AVERAGE_CPA');
    });

    document.getElementById('add_network_pay_for_conversion_goal_btn')?.addEventListener('click', function() {
        const container = document.getElementById('network_pay_for_conversion_goals_container');
        container.appendChild(createGoalElement('network_pay_for_conversion_goals', 'ConversionPrice', 'Цена конверсии'));
        validateGoals('PAY_FOR_CONVERSION');
    });

    // Инициализация при загрузке страницы
    updateStrategyParams();
});
</script>
@endpush 