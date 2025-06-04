<!-- Расписание показов -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Расписание показов</h6>
            
            <div class="mb-3">
                <label for="schedule_type" class="form-label">Расписание</label>
                <select class="form-select @error('schedule_type') is-invalid @enderror" 
                        id="schedule_type" name="schedule_type" required>
                    <option value="everyday" {{ old('schedule_type', 'everyday') == 'everyday' ? 'selected' : '' }}>Каждый день, круглосуточно</option>
                    <option value="workdays" {{ old('schedule_type') == 'workdays' ? 'selected' : '' }}>По будням с 8:00 до 20:00</option>
                </select>
                @error('schedule_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Дополнительные настройки для расписания по будням -->
            <div id="workdays_settings" style="display: none;">
                <div class="mb-3">
                    <label for="timezone" class="form-label">Часовой пояс</label>
                    <select class="form-select @error('timezone') is-invalid @enderror" 
                            id="timezone" name="timezone">
                        <option value="moscow" {{ old('timezone', 'moscow') == 'moscow' ? 'selected' : '' }}>Москва</option>
                        <option value="kaliningrad" {{ old('timezone') == 'kaliningrad' ? 'selected' : '' }}>Калининград (MSK -01:00)</option>
                        <option value="samara" {{ old('timezone') == 'samara' ? 'selected' : '' }}>Самара (MSK +01:00)</option>
                        <option value="ivanovka" {{ old('timezone') == 'ivanovka' ? 'selected' : '' }}>Ивановка (MSK +01:00)</option>
                        <option value="ulyanovsk" {{ old('timezone') == 'ulyanovsk' ? 'selected' : '' }}>Ульяновск (MSK +01:00)</option>
                        <option value="ekaterinburg" {{ old('timezone') == 'ekaterinburg' ? 'selected' : '' }}>Екатеринбург (MSK +02:00)</option>
                        <option value="omsk" {{ old('timezone') == 'omsk' ? 'selected' : '' }}>Омск (MSK +03:00)</option>
                        <option value="krasnoyarsk" {{ old('timezone') == 'krasnoyarsk' ? 'selected' : '' }}>Красноярск (MSK +04:00)</option>
                        <option value="novokuznetsk" {{ old('timezone') == 'novokuznetsk' ? 'selected' : '' }}>Новокузнецк (MSK +04:00)</option>
                        <option value="tomsk" {{ old('timezone') == 'tomsk' ? 'selected' : '' }}>Томск (MSK +04:00)</option>
                        <option value="barnaul" {{ old('timezone') == 'barnaul' ? 'selected' : '' }}>Барнаул (MSK +04:00)</option>
                        <option value="irkutsk" {{ old('timezone') == 'irkutsk' ? 'selected' : '' }}>Иркутск (MSK +05:00)</option>
                        <option value="yakutsk" {{ old('timezone') == 'yakutsk' ? 'selected' : '' }}>Якутск (MSK +06:00)</option>
                        <option value="chita" {{ old('timezone') == 'chita' ? 'selected' : '' }}>Чита (MSK +06:00)</option>
                        <option value="vladivostok" {{ old('timezone') == 'vladivostok' ? 'selected' : '' }}>Владивосток (MSK +07:00)</option>
                        <option value="srednekolymsk" {{ old('timezone') == 'srednekolymsk' ? 'selected' : '' }}>Среднеколымск (MSK +08:00)</option>
                        <option value="petropavlovsk" {{ old('timezone') == 'petropavlovsk' ? 'selected' : '' }}>Петропавловск (MSK +09:00)</option>
                    </select>
                    @error('timezone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="holiday_schedule" class="form-label">В праздничные дни</label>
                    <select class="form-select @error('holiday_schedule') is-invalid @enderror" 
                            id="holiday_schedule" name="holiday_schedule">
                        <option value="dont_show" {{ old('holiday_schedule', 'dont_show') == 'dont_show' ? 'selected' : '' }}>Не показывать</option>
                        <option value="by_schedule" {{ old('holiday_schedule') == 'by_schedule' ? 'selected' : '' }}>По расписанию соответствующего дня недели</option>
                    </select>
                    @error('holiday_schedule')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Параметры URL -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Параметры URL</h6>
            
            <div class="mb-3">
                <label for="url_parameters" class="form-label">Параметры URL</label>
                <input type="text" class="form-control @error('url_parameters') is-invalid @enderror" 
                       id="url_parameters" name="url_parameters" 
                       value="{{ old('url_parameters') }}"
                       placeholder="Например: utm_source=yandex&utm_medium=cpc&utm_campaign=campaign_name">
                <div class="form-text">Введите параметры или UTM-метки. Они добавятся ко всем ссылкам, указанным в настройках объявлений внутри кампании.</div>
                @error('url_parameters')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<!-- Дополнительные настройки -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Дополнительные настройки</h6>
            
            <!-- Переключатели -->
            <div class="mb-4">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="site_monitoring" name="site_monitoring" 
                           {{ old('site_monitoring', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="site_monitoring">
                        Мониторинг сайта
                        <small class="d-block text-muted">
                            Если рекламируемый сайт будет недоступен, объявления автоматически остановятся, а вы получите уведомление. Показы возобновятся с восстановлением работы сайта.
                        </small>
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="extended_geo_targeting" name="extended_geo_targeting" 
                           {{ old('extended_geo_targeting', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="extended_geo_targeting">
                        Расширенный географический таргетинг
                        <small class="d-block text-muted">
                            Если в поисковом запросе есть название региона, указанного в географии показов, то пользователь увидит рекламу, даже если находится в другом регионе. Например, по запросу «купить квартиру в Москве» объявления могут показываться жителям любых регионов. В Рекламной сети пользователь может увидеть объявление, нацеленное на его регулярный регион, даже если сейчас он из него уехал.
                        </small>
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="organization_info" name="organization_info" 
                           {{ old('organization_info', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="organization_info">
                        Информация об организации в объявлениях на Картах
                        <small class="d-block text-muted">
                            Фотографии, рейтинг и отзывы из Яндекс Бизнеса. Это сделает объявления более заметными, а клиенты смогут подробнее ознакомиться с вашим предложением.
                        </small>
                    </label>
                </div>
            </div>

            <!-- Директ помогает -->
            <div class="mb-4">
                <h6 class="mb-3">Директ помогает</h6>
                
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="auto_recommendations" name="auto_recommendations" 
                           {{ old('auto_recommendations') ? 'checked' : '' }}>
                    <label class="form-check-label" for="auto_recommendations">
                        Автоматически применять рекомендации
                        <small class="d-block text-muted">
                            Алгоритмы Директа будут анализировать рекламу и корректировать настройки. Например, заменят неэффективные изображения, нецелевые тематические слова, добавят счётчик Метрики или цели, начнут продвигать вашу организацию в Картах. Так реклама станет эффективнее.
                        </small>
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="optimize_extended_settings" name="optimize_extended_settings" 
                           {{ old('optimize_extended_settings') ? 'checked' : '' }}>
                    <label class="form-check-label" for="optimize_extended_settings">
                        Оптимизировать расширенные настройки — цели, подбор аудитории, недельный бюджет
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="optimize_ad_text" name="optimize_ad_text" 
                           {{ old('optimize_ad_text') ? 'checked' : '' }}>
                    <label class="form-check-label" for="optimize_ad_text">
                        Оптимизировать текст объявлений под запрос
                        <small class="d-block text-muted">
                            Это может сделать текстово-графические объявления более релевантными поисковым запросам и принести больше конверсий.
                        </small>
                    </label>
                </div>
            </div>

            <!-- Приоритизация объявлений -->
            <div class="mb-3">
                <h6 class="mb-3">Приоритизация объявлений</h6>
                
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="ad_priority" id="priority_best_metrics" 
                           value="best_metrics" {{ old('ad_priority', 'best_metrics') == 'best_metrics' ? 'checked' : '' }}>
                    <label class="form-check-label" for="priority_best_metrics">
                        С лучшим сочетанием показателей
                        <small class="d-block text-muted">
                            Учитываются прогнозируемая кликабельность (CTR), коэффициент качества объявления и ставка для фразы
                        </small>
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ad_priority" id="priority_closest_phrase" 
                           value="closest_phrase" {{ old('ad_priority') == 'closest_phrase' ? 'checked' : '' }}>
                    <label class="form-check-label" for="priority_closest_phrase">
                        По фразе, наиболее близкой к запросу
                        <small class="d-block text-muted">
                            Ставка для фразы не учитывается
                        </small>
                    </label>
                </div>
            </div>

            <!-- Корректировки ставок -->
            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">Корректировки ставок</h6>
                        
                        <!-- Пол и возраст -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Пол и возраст</h6>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addDemographicsModifier()">
                                    <i class="bi bi-plus"></i> Добавить корректировку
                                </button>
                            </div>
                            
                            <div id="demographics_modifiers">
                                <!-- Здесь будут добавляться корректировки -->
                            </div>
                        </div>

                        <!-- Устройства -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Устройства</h6>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addDeviceModifier()">
                                    <i class="bi bi-plus"></i> Добавить корректировку
                                </button>
                            </div>
                            
                            <div id="device_modifiers">
                                <!-- Здесь будут добавляться корректировки -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Шаблон для корректировки пола и возраста
const demographicsTemplate = `
    <div class="demographics-modifier mb-3 p-3 border rounded">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="row g-3 flex-grow-1">
                <div class="col-md-4">
                    <select class="form-select" name="bid_modifiers[demographics][{index}][gender]">
                        <option value="any">Любой пол</option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="bid_modifiers[demographics][{index}][age]">
                        <option value="under_18">Младше 18</option>
                        <option value="18_24">18-24 года</option>
                        <option value="25_34">25-34 года</option>
                        <option value="35_44">35-44 года</option>
                        <option value="45_54">45-54 года</option>
                        <option value="over_55">Старше 55</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="number" class="form-control bid-modifier" 
                               name="bid_modifiers[demographics][{index}][adjustment]" 
                               value="0" min="-100" max="500" step="1">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removeModifier(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>
`;

// Шаблон для корректировки устройств
const deviceTemplate = `
    <div class="device-modifier mb-3 p-3 border rounded">
        <div class="d-flex justify-content-between align-items-start mb-2">
            <div class="row g-3 flex-grow-1">
                <div class="col-md-6">
                    <select class="form-select" name="bid_modifiers[device][{index}][type]">
                        <option value="desktop">Декстопы</option>
                        <option value="smart_tv">Smart TV</option>
                        <option value="mobile">Смартфоны</option>
                        <option value="tablet">Планшеты</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="number" class="form-control bid-modifier" 
                               name="bid_modifiers[device][{index}][adjustment]" 
                               value="0" min="-100" max="500" step="1">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removeModifier(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>
`;

let demographicsIndex = 0;
let deviceIndex = 0;

// Добавление корректировки пола и возраста
function addDemographicsModifier() {
    const container = document.getElementById('demographics_modifiers');
    if (!container) {
        console.error('Container demographics_modifiers not found');
        return;
    }
    const modifier = demographicsTemplate.replace(/{index}/g, demographicsIndex++);
    container.insertAdjacentHTML('beforeend', modifier);
    initializeBidModifiers();
}

// Добавление корректировки устройств
function addDeviceModifier() {
    const container = document.getElementById('device_modifiers');
    if (!container) {
        console.error('Container device_modifiers not found');
        return;
    }
    const modifier = deviceTemplate.replace(/{index}/g, deviceIndex++);
    container.insertAdjacentHTML('beforeend', modifier);
    initializeBidModifiers();
}

// Удаление корректировки
function removeModifier(button) {
    button.closest('.demographics-modifier, .device-modifier').remove();
}

// Инициализация обработчиков для корректировок ставок
function initializeBidModifiers() {
    document.querySelectorAll('.bid-modifier').forEach(input => {
        input.addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value < 0) {
                this.classList.remove('text-success');
                this.classList.add('text-danger');
            } else if (value > 0) {
                this.classList.remove('text-danger');
                this.classList.add('text-success');
            } else {
                this.classList.remove('text-danger', 'text-success');
            }
        });
    });
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    // Добавляем первую корректировку для демографии и устройств
    addDemographicsModifier();
    addDeviceModifier();
});
</script> 