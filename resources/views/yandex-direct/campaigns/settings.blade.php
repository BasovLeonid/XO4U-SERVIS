@props(['settings' => null])

<!-- Параметры URL -->
<div class="mb-4">
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label for="tracking_params" class="form-label">Параметры URL</label>
                <input type="text" class="form-control @error('tracking_params') is-invalid @enderror" 
                       id="tracking_params" name="tracking_params" 
                       value="{{ old('tracking_params', $settings->first()?->tracking_params) }}"
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
                <select class="form-select" id="attribution_model" name="attribution_model" disabled>
                    <option value="AUTO" {{ old('attribution_model', $settings->first()?->attribution_model) == 'AUTO' ? 'selected' : '' }}>Автоматическая</option>
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
                    <input class="form-check-input" type="checkbox" id="enable_site_monitoring" name="settings[ENABLE_SITE_MONITORING]" 
                           value="YES" {{ old('settings.ENABLE_SITE_MONITORING', $settings->first()?->enable_site_monitoring) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enable_site_monitoring">
                        Мониторинг сайта
                        <small class="d-block text-muted">
                            Если рекламируемый сайт будет недоступен, объявления автоматически остановятся, а вы получите уведомление. Показы возобновятся с восстановлением работы сайта.
                        </small>
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="enable_area_of_interest_targeting" name="settings[ENABLE_AREA_OF_INTEREST_TARGETING]" 
                           value="YES" {{ old('settings.ENABLE_AREA_OF_INTEREST_TARGETING', $settings->first()?->enable_area_of_interest_targeting) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enable_area_of_interest_targeting">
                        Расширенный географический таргетинг
                        <small class="d-block text-muted">
                            Если в поисковом запросе есть название региона, указанного в географии показов, то пользователь увидит рекламу, даже если находится в другом регионе. Например, по запросу «купить квартиру в Москве» объявления могут показываться жителям любых регионов. В Рекламной сети пользователь может увидеть объявление, нацеленное на его регулярный регион, даже если сейчас он из него уехал.
                        </small>
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="enable_company_info" name="settings[ENABLE_COMPANY_INFO]" 
                           value="YES" {{ old('settings.ENABLE_COMPANY_INFO', $settings->first()?->enable_company_info) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enable_company_info">
                        Информация об организации в объявлениях на Картах
                        <small class="d-block text-muted">
                            Фотографии, рейтинг и отзывы из Яндекс Бизнеса. Это сделает объявления более заметными, а клиенты смогут подробнее ознакомиться с вашим предложением.
                        </small>
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="add_metrica_tag" name="settings[ADD_METRICA_TAG]" 
                           value="YES" {{ old('settings.ADD_METRICA_TAG', $settings->first()?->add_metrica_tag) ? 'checked' : '' }}>
                    <label class="form-check-label" for="add_metrica_tag">
                        Добавить счетчик Метрики
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="add_openstat_tag" name="settings[ADD_OPENSTAT_TAG]" 
                           value="YES" {{ old('settings.ADD_OPENSTAT_TAG', $settings->first()?->add_openstat_tag) ? 'checked' : '' }}>
                    <label class="form-check-label" for="add_openstat_tag">
                        Добавить счетчик OpenStat
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="enable_extended_ad_title" name="settings[ENABLE_EXTENDED_AD_TITLE]" 
                           value="YES" {{ old('settings.ENABLE_EXTENDED_AD_TITLE', $settings->first()?->enable_extended_ad_title) ? 'checked' : '' }}>
                    <label class="form-check-label" for="enable_extended_ad_title">
                        Расширенный заголовок объявления
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="exclude_paused_competing_ads" name="settings[EXCLUDE_PAUSED_COMPETING_ADS]" 
                           value="YES" {{ old('settings.EXCLUDE_PAUSED_COMPETING_ADS', $settings->first()?->exclude_paused_competing_ads) ? 'checked' : '' }}>
                    <label class="form-check-label" for="exclude_paused_competing_ads">
                        Исключить приостановленные конкурирующие объявления
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="maintain_network_cpc" name="settings[MAINTAIN_NETWORK_CPC]" 
                           value="YES" {{ old('settings.MAINTAIN_NETWORK_CPC', $settings->first()?->maintain_network_cpc) ? 'checked' : '' }}>
                    <label class="form-check-label" for="maintain_network_cpc">
                        Сохранять ставки в сетях
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="require_servicing" name="settings[REQUIRE_SERVICING]" 
                           value="YES" {{ old('settings.REQUIRE_SERVICING', $settings->first()?->require_servicing) ? 'checked' : '' }}>
                    <label class="form-check-label" for="require_servicing">
                        Требовать обслуживание
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="shared_account_enabled" name="settings[SHARED_ACCOUNT_ENABLED]" 
                           value="YES" {{ old('settings.SHARED_ACCOUNT_ENABLED', $settings->first()?->shared_account_enabled) ? 'checked' : '' }}>
                    <label class="form-check-label" for="shared_account_enabled">
                        Включить общий аккаунт
                    </label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="alternative_texts_enabled" name="settings[ALTERNATIVE_TEXTS_ENABLED]" 
                           value="YES" {{ old('settings.ALTERNATIVE_TEXTS_ENABLED', $settings->first()?->alternative_texts_enabled) ? 'checked' : '' }}>
                    <label class="form-check-label" for="alternative_texts_enabled">
                        Включить альтернативные тексты
                    </label>
                </div>
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
                       value="YES" {{ old('settings.CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED', $settings->first()?->campaign_exact_phrase_matching_enabled) ? 'checked' : '' }}>
                <label class="form-check-label" for="priority_best_metrics">
                    С лучшим сочетанием показателей
                    <small class="d-block text-muted">
                        Учитываются прогнозируемая кликабельность (CTR), коэффициент качества объявления и ставка для фразы
                    </small>
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="settings[CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED]" id="priority_closest_phrase" 
                       value="NO" {{ !old('settings.CAMPAIGN_EXACT_PHRASE_MATCHING_ENABLED', $settings->first()?->campaign_exact_phrase_matching_enabled) ? 'checked' : '' }}>
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