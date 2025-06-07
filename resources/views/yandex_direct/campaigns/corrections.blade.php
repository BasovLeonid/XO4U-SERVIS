@props(['campaign' => null])

<div class="card" id="corrections-component">
    <div class="card-header">
        <h3>Корректировки ставок</h3>
    </div>
    <div class="card-body">
        <!-- Корректировки по полу и возрасту -->
        <div class="mb-4">
            <h4>Корректировки по полу и возрасту</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Пол / Возраст</th>
                            <th>Младше 18</th>
                            <th>18-24 года</th>
                            <th>25-34 года</th>
                            <th>35-44 года</th>
                            <th>45-54 года</th>
                            <th>Старше 55</th>
                            <th>Любой возраст</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Любой пол</td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[][0_17]" min="-100" max="500" step="1" placeholder="%" value="-100"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[][18_24]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[][25_34]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[][35_44]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[][45_54]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[][55_plus]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[][]" min="-100" max="500" step="1" placeholder="%"></td>
                        </tr>
                        <tr>
                            <td>Мужской</td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[MALE][0_17]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[MALE][18_24]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[MALE][25_34]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[MALE][35_44]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[MALE][45_54]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[MALE][55_plus]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[MALE][]" min="-100" max="500" step="1" placeholder="%"></td>
                        </tr>
                        <tr>
                            <td>Женский</td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[FEMALE][0_17]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[FEMALE][18_24]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[FEMALE][25_34]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[FEMALE][35_44]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[FEMALE][45_54]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[FEMALE][55_plus]" min="-100" max="500" step="1" placeholder="%"></td>
                            <td><input type="number" class="form-control correction-value" name="DemographicsAdjustments[FEMALE][]" min="-100" max="500" step="1" placeholder="%"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Корректировки по устройствам -->
        <div class="mb-4">
            <h4>Корректировки по устройствам</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Декстопы</h5>
                            <input type="number" class="form-control correction-value" name="DeviceAdjustments[DESKTOP]" min="-100" max="500" step="1" placeholder="% корректировки">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Smart TV</h5>
                            <input type="number" class="form-control correction-value" name="DeviceAdjustments[SMART_TV]" min="-100" max="500" step="1" placeholder="% корректировки">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Смартфоны</h5>
                            <input type="number" class="form-control correction-value" name="DeviceAdjustments[MOBILE]" min="-100" max="500" step="1" placeholder="% корректировки">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Планшеты</h5>
                            <input type="number" class="form-control correction-value" name="DeviceAdjustments[TABLET]" min="-100" max="500" step="1" placeholder="% корректировки">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Подсказка по корректировкам -->
        <div class="mt-4">
            <div class="alert alert-info">
                <h5 class="alert-heading"><i class="fas fa-info-circle"></i> Подсказка по корректировкам:</h5>
                <ul class="mb-0">
                    <li>0% или не указано = 100% от базовой ставки</li>
                    <li>-100% = показы отключены</li>
                    <li>100% = ставка x2 (двойная цена)</li>
                    <li>500% = максимальное увеличение ставки</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@once
@push('styles')
<style>
    #corrections-component .correction-value {
        transition: all 0.3s;
    }
    #corrections-component .correction-value.negative {
        background-color: rgba(255, 0, 0, 0.1);
        border-color: #dc3545;
    }
    #corrections-component .correction-value.positive {
        background-color: rgba(0, 255, 0, 0.1);
        border-color: #28a745;
    }
    #corrections-component .table td {
        vertical-align: middle;
    }
    #corrections-component .card {
        transition: all 0.3s;
    }
    #corrections-component .card:hover {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    #corrections-component .validation-error {
        border-color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
    }
    #corrections-component .validation-error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    #corrections-component .alert-info {
        background-color: #f8f9fa;
        border-color: #e9ecef;
        color: #495057;
    }
    #corrections-component .alert-info .alert-heading {
        color: #0c5460;
    }
</style>
@endpush

@push('scripts')
<script>
(function() {
    const CorrectionsComponent = {
        init: function() {
            this.bindEvents();
        },

        bindEvents: function() {
            const component = document.getElementById('corrections-component');
            if (!component) return;

            // Обработка изменений значений
            component.addEventListener('input', (e) => {
                if (e.target.classList.contains('correction-value')) {
                    this.updateCorrectionValueColor(e.target);
                    this.validateCorrections(e.target);
                }
            });
        },

        updateCorrectionValueColor: function(input) {
            const value = parseInt(input.value);
            input.classList.remove('negative', 'positive');
            if (value < 0) {
                input.classList.add('negative');
            } else if (value > 0) {
                input.classList.add('positive');
            }
        },

        validateCorrections: function(input) {
            const component = document.getElementById('corrections-component');
            const name = input.name;
            
            // Сброс предыдущих ошибок
            component.querySelectorAll('.validation-error-message').forEach(el => el.remove());
            component.querySelectorAll('.validation-error').forEach(el => el.classList.remove('validation-error'));

            // Проверка на конфликты
            if (name.includes('DemographicsAdjustments[')) {
                const [_, gender, age] = name.match(/DemographicsAdjustments\[(.*?)\]\[(.*?)\]/);
                
                // Проверка конфликта с "Любой пол"
                if (gender && age) {
                    const anyGenderInput = component.querySelector(`input[name="DemographicsAdjustments[][${age}]"]`);
                    if (anyGenderInput && anyGenderInput.value && input.value) {
                        this.markAsError(input, 'Конфликт с корректировкой "Любой пол"');
                        this.markAsError(anyGenderInput, 'Конфликт с корректировкой для конкретного пола');
                    }
                }

                // Проверка конфликта с "Любой возраст"
                if (gender && age) {
                    const anyAgeInput = component.querySelector(`input[name="DemographicsAdjustments[${gender}][]"]`);
                    if (anyAgeInput && anyAgeInput.value && input.value) {
                        this.markAsError(input, 'Конфликт с корректировкой "Любой возраст"');
                        this.markAsError(anyAgeInput, 'Конфликт с корректировкой для конкретного возраста');
                    }
                }
            }
        },

        markAsError: function(input, message) {
            input.classList.add('validation-error');
            
            const errorMessage = document.createElement('div');
            errorMessage.className = 'validation-error-message';
            errorMessage.textContent = message;
            input.parentNode.appendChild(errorMessage);
        }
    };

    // Инициализация компонента при загрузке DOM
    document.addEventListener('DOMContentLoaded', function() {
        CorrectionsComponent.init();
    });
})();
</script>
@endpush
@endonce 