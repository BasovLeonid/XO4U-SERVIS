@props(['bidAdjustments' => null])

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
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][0_17]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.0_17', $bidAdjustments->first()?->demographics_adjustments['items'][0]['0_17'] ?? -100) }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][18_24]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.18_24', $bidAdjustments->first()?->demographics_adjustments['items'][0]['18_24'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][25_34]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.25_34', $bidAdjustments->first()?->demographics_adjustments['items'][0]['25_34'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][35_44]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.35_44', $bidAdjustments->first()?->demographics_adjustments['items'][0]['35_44'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][45_54]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.45_54', $bidAdjustments->first()?->demographics_adjustments['items'][0]['45_54'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][55_plus]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.55_plus', $bidAdjustments->first()?->demographics_adjustments['items'][0]['55_plus'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.any', $bidAdjustments->first()?->demographics_adjustments['items'][0]['any'] ?? '') }}"></td>
                        </tr>
                        <tr>
                            <td>Мужской</td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_MALE][0_17]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_MALE.0_17', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_MALE']['0_17'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_MALE][18_24]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_MALE.18_24', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_MALE']['18_24'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_MALE][25_34]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_MALE.25_34', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_MALE']['25_34'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_MALE][35_44]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_MALE.35_44', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_MALE']['35_44'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_MALE][45_54]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_MALE.45_54', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_MALE']['45_54'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_MALE][55_plus]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_MALE.55_plus', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_MALE']['55_plus'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_MALE][]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_MALE.any', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_MALE']['any'] ?? '') }}"></td>
                        </tr>
                        <tr>
                            <td>Женский</td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_FEMALE][0_17]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_FEMALE.0_17', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_FEMALE']['0_17'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_FEMALE][18_24]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_FEMALE.18_24', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_FEMALE']['18_24'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_FEMALE][25_34]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_FEMALE.25_34', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_FEMALE']['25_34'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_FEMALE][35_44]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_FEMALE.35_44', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_FEMALE']['35_44'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_FEMALE][45_54]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_FEMALE.45_54', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_FEMALE']['45_54'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_FEMALE][55_plus]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_FEMALE.55_plus', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_FEMALE']['55_plus'] ?? '') }}"></td>
                            <td><input type="number" class="form-control correction-value" name="demographics_adjustments[items][][GENDER_FEMALE][]" min="-100" max="500" step="1" placeholder="%" value="{{ old('demographics_adjustments.items.GENDER_FEMALE.any', $bidAdjustments->first()?->demographics_adjustments['items'][0]['GENDER_FEMALE']['any'] ?? '') }}"></td>
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
                            <input type="number" class="form-control correction-value" name="desktop_adjustment[bid_modifier]" min="-100" max="500" step="1" placeholder="% корректировки" value="{{ old('desktop_adjustment.bid_modifier', $bidAdjustments->first()?->desktop_adjustment['bid_modifier'] ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Smart TV</h5>
                            <input type="number" class="form-control correction-value" name="smart_tv_adjustment[bid_modifier]" min="-100" max="500" step="1" placeholder="% корректировки" value="{{ old('smart_tv_adjustment.bid_modifier', $bidAdjustments->first()?->smart_tv_adjustment['bid_modifier'] ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Смартфоны</h5>
                            <input type="number" class="form-control correction-value" name="mobile_adjustment[bid_modifier]" min="-100" max="500" step="1" placeholder="% корректировки" value="{{ old('mobile_adjustment.bid_modifier', $bidAdjustments->first()?->mobile_adjustment['bid_modifier'] ?? '') }}">
                            <select class="form-select mt-2" name="mobile_adjustment[operating_system_type]">
                                <option value="">Любая ОС</option>
                                <option value="IOS" {{ old('mobile_adjustment.operating_system_type', $bidAdjustments->first()?->mobile_adjustment['operating_system_type'] ?? '') == 'IOS' ? 'selected' : '' }}>iOS</option>
                                <option value="ANDROID" {{ old('mobile_adjustment.operating_system_type', $bidAdjustments->first()?->mobile_adjustment['operating_system_type'] ?? '') == 'ANDROID' ? 'selected' : '' }}>Android</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Планшеты</h5>
                            <input type="number" class="form-control correction-value" name="tablet_adjustment[bid_modifier]" min="-100" max="500" step="1" placeholder="% корректировки" value="{{ old('tablet_adjustment.bid_modifier', $bidAdjustments->first()?->tablet_adjustment['bid_modifier'] ?? '') }}">
                            <select class="form-select mt-2" name="tablet_adjustment[operating_system_type]">
                                <option value="">Любая ОС</option>
                                <option value="IOS" {{ old('tablet_adjustment.operating_system_type', $bidAdjustments->first()?->tablet_adjustment['operating_system_type'] ?? '') == 'IOS' ? 'selected' : '' }}>iOS</option>
                                <option value="ANDROID" {{ old('tablet_adjustment.operating_system_type', $bidAdjustments->first()?->tablet_adjustment['operating_system_type'] ?? '') == 'ANDROID' ? 'selected' : '' }}>Android</option>
                            </select>
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
@push('scripts')
<script>
(function() {
    const CorrectionsComponent = {
        init: function() {
            this.bindEvents();
            this.initializeExistingValues();
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

        initializeExistingValues: function() {
            const component = document.getElementById('corrections-component');
            if (!component) return;

            // Применяем стили ко всем существующим значениям
            component.querySelectorAll('.correction-value').forEach(input => {
                this.updateCorrectionValueColor(input);
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
            if (name.includes('demographics_adjustments[items]')) {
                const [_, gender, age] = name.match(/demographics_adjustments\[items\]\[(.*?)\]\[(.*?)\]/);
                
                // Проверка конфликта с "Любой пол"
                if (gender && age) {
                    const anyGenderInput = component.querySelector(`input[name="demographics_adjustments[items][][${age}]"]`);
                    if (anyGenderInput && anyGenderInput.value && input.value) {
                        this.markAsError(input, 'Конфликт с корректировкой "Любой пол"');
                        this.markAsError(anyGenderInput, 'Конфликт с корректировкой для конкретного пола');
                    }
                }

                // Проверка конфликта с "Любой возраст"
                if (gender && age) {
                    const anyAgeInput = component.querySelector(`input[name="demographics_adjustments[items][][${gender}][]"]`);
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