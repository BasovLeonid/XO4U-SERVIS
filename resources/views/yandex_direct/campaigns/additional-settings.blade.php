<!-- Параметры URL -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Параметры URL</h6>
            
            <div class="mb-3">
                <label for="tracking_params" class="form-label">Параметры URL</label>
                <input type="text" class="form-control @error('tracking_params') is-invalid @enderror" 
                       id="tracking_params" name="tracking_params" 
                       value="{{ old('tracking_params') }}"
                       placeholder="Например: utm_source=yandex&utm_medium=cpc&utm_campaign=campaign_name">
                <div class="form-text">Введите параметры или UTM-метки. Они добавятся ко всем ссылкам, указанным в настройках объявлений внутри кампании.</div>
                @error('tracking_params')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<!-- Модель атрибуции -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Модель атрибуции</h6>
            
            <div class="mb-3">
                <label for="attribution_model" class="form-label">Модель атрибуции</label>
                <select class="form-select" id="attribution_model" name="AttributionModel" disabled>
                    <option value="AUTO" selected>Автоматическая</option>
                </select>
                <div class="form-text">В текущей версии доступна только автоматическая модель атрибуции.</div>
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
                    <input class="form-check-input" type="checkbox" id="enable_site_monitoring" name="Settings[0][Option]" 
                           value="ENABLE_SITE_MONITORING" {{ old('Settings.0.Option', 'ENABLE_SITE_MONITORING') == 'ENABLE_SITE_MONITORING' ? 'checked' : '' }}>
                    <input type="hidden" name="Settings[0][Value]" value="YES">
                    <label class="form-check-label" for="enable_site_monitoring">
                        Мониторинг сайта
                        <small class="d-block text-muted">
                            Если рекламируемый сайт будет недоступен, объявления автоматически остановятся, а вы получите уведомление. Показы возобновятся с восстановлением работы сайта.
                        </small>
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="enable_area_of_interest_targeting" name="settings[ENABLE_AREA_OF_INTEREST_TARGETING]" 
                           value="YES" {{ old('settings.ENABLE_AREA_OF_INTEREST_TARGETING', 'YES') == 'YES' ? 'checked' : '' }}>
                    <label class="form-check-label" for="enable_area_of_interest_targeting">
                        Расширенный географический таргетинг
                        <small class="d-block text-muted">
                            Если в поисковом запросе есть название региона, указанного в географии показов, то пользователь увидит рекламу, даже если находится в другом регионе. Например, по запросу «купить квартиру в Москве» объявления могут показываться жителям любых регионов. В Рекламной сети пользователь может увидеть объявление, нацеленное на его регулярный регион, даже если сейчас он из него уехал.
                        </small>
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="enable_company_info" name="settings[ENABLE_COMPANY_INFO]" 
                           value="YES" {{ old('settings.ENABLE_COMPANY_INFO', 'YES') == 'YES' ? 'checked' : '' }}>
                    <label class="form-check-label" for="enable_company_info">
                        Информация об организации в объявлениях на Картах
                        <small class="d-block text-muted">
                            Фотографии, рейтинг и отзывы из Яндекс Бизнеса. Это сделает объявления более заметными, а клиенты смогут подробнее ознакомиться с вашим предложением.
                        </small>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Директ помогает -->
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-light">
            <h6 class="mb-0">Директ помогает</h6>
        </div>
        <div class="card-body">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="auto_recommendations" name="settings[ENABLE_AUTO_RECOMMENDATIONS]" 
                       value="YES" {{ old('settings.ENABLE_AUTO_RECOMMENDATIONS') == 'YES' ? 'checked' : '' }}>
                <label class="form-check-label" for="auto_recommendations">
                    Автоматически применять рекомендации
                    <small class="d-block text-muted">
                        Алгоритмы Директа будут анализировать рекламу и корректировать настройки. Например, заменят неэффективные изображения, нецелевые тематические слова, добавят счётчик Метрики или цели, начнут продвигать вашу организацию в Картах. Так реклама станет эффективнее.
                    </small>
                </label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="optimize_extended_settings" name="settings[ENABLE_EXTENDED_SETTINGS_OPTIMIZATION]" 
                       value="YES" {{ old('settings.ENABLE_EXTENDED_SETTINGS_OPTIMIZATION') == 'YES' ? 'checked' : '' }}>
                <label class="form-check-label" for="optimize_extended_settings">
                    Оптимизировать расширенные настройки — цели, подбор аудитории, недельный бюджет
                </label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="optimize_ad_text" name="settings[ENABLE_AD_TEXT_OPTIMIZATION]" 
                       value="YES" {{ old('settings.ENABLE_AD_TEXT_OPTIMIZATION') == 'YES' ? 'checked' : '' }}>
                <label class="form-check-label" for="optimize_ad_text">
                    Оптимизировать текст объявлений под запрос
                    <small class="d-block text-muted">
                        Это может сделать текстово-графические объявления более релевантными поисковым запросам и принести больше конверсий.
                    </small>
                </label>
            </div>
        </div>
    </div>
</div>

<!-- Приоритизация объявлений -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Приоритизация объявлений</h6>
            
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="settings[CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED]" id="priority_best_metrics" 
                       value="YES" {{ old('settings.CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED', 'YES') == 'YES' ? 'checked' : '' }}>
                <label class="form-check-label" for="priority_best_metrics">
                    С лучшим сочетанием показателей
                    <small class="d-block text-muted">
                        Учитываются прогнозируемая кликабельность (CTR), коэффициент качества объявления и ставка для фразы
                    </small>
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="settings[CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED]" id="priority_closest_phrase" 
                       value="NO" {{ old('settings.CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED') == 'NO' ? 'checked' : '' }}>
                <label class="form-check-label" for="priority_closest_phrase">
                    По фразе, наиболее близкой к запросу
                    <small class="d-block text-muted">
                        Ставка для фразы не учитывается
                    </small>
                </label>
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