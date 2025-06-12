@props(['metrics' => null])

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Цели Яндекс Метрики</h5>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="metrics_counter_ids">ID счетчиков Яндекс.Метрики</label>
            <input type="text" class="form-control" id="metrics_counter_ids" name="counter_ids[]" 
                   placeholder="Введите ID счетчиков через запятую" 
                   value="{{ old('counter_ids', $metrics->first()?->counter_ids ? implode(',', (array)$metrics->first()?->counter_ids) : '') }}">
            <small class="form-text text-muted">Введите ID счетчиков через запятую, например: 123456, 789012</small>
        </div>

        <div class="form-group mb-3">
            <label>Цели и их значения</label>
            <div id="metrics_goals_container">
                @if(old('priority_goals') || $metrics->first()?->priority_goals)
                    @foreach(old('priority_goals', $metrics->first()?->priority_goals ?? []) as $goal)
                        <div class="metrics-goal-item mb-3 p-3 border rounded">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">ID цели</label>
                                    <input type="text" class="form-control metrics-goal-id" name="priority_goals[][GoalId]" 
                                           value="{{ $goal['GoalId'] ?? '' }}" placeholder="Введите ID цели" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ценность конверсии (руб.)</label>
                                    <input type="number" class="form-control metrics-goal-value" name="priority_goals[][Value]" 
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
                                    <button type="button" class="btn btn-outline-danger metrics-remove-goal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn btn-outline-primary mt-2" id="add_metrics_goal_btn">
                <i class="fas fa-plus"></i> Добавить цель
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Функция для создания элемента цели
    function createMetricsGoalElement(goalId = '', value = '', isMetrikaSource = 'YES') {
        const div = document.createElement('div');
        div.className = 'metrics-goal-item mb-3 p-3 border rounded';
        div.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">ID цели</label>
                    <input type="text" class="form-control metrics-goal-id" name="priority_goals[][GoalId]" 
                           value="${goalId}" placeholder="Введите ID цели" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ценность конверсии (руб.)</label>
                    <input type="number" class="form-control metrics-goal-value" name="priority_goals[][Value]" 
                           value="${value}" step="0.01" min="0" placeholder="Введите ценность" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Использовать значение из Метрики</label>
                    <select class="form-control" name="priority_goals[][IsMetrikaSourceOfValue]">
                        <option value="YES" ${isMetrikaSource === 'YES' ? 'selected' : ''}>Да</option>
                        <option value="NO" ${isMetrikaSource === 'NO' ? 'selected' : ''}>Нет</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-danger metrics-remove-goal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        return div;
    }

    // Обработчик добавления цели
    document.getElementById('add_metrics_goal_btn').addEventListener('click', function() {
        const container = document.getElementById('metrics_goals_container');
        container.appendChild(createMetricsGoalElement());
    });

    // Обработчик удаления цели
    document.addEventListener('click', function(e) {
        if (e.target.closest('.metrics-remove-goal')) {
            const goalItem = e.target.closest('.metrics-goal-item');
            goalItem.remove();
        }
    });

    // Обработка счетчиков
    const counterIdsInput = document.getElementById('metrics_counter_ids');
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
});
</script>
@endpush 