<!-- Параметры URL -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
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