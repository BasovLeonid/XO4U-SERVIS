<!DOCTYPE html>
<html lang="ru">
<head>
    @include('yandex-direct.partials.head')
    <style>
        @include('yandex-direct.partials.styles')
    </style>
    @stack('styles')
</head>
<body>
<form id="saveForm1" action="{{ route('interface.yandex-direct.update-settings', ['campaign' => $campaign->first()?->id]) }}" method="POST" class="d-inline">
    <div class="yandex-direct-interface">
        <div class="interface-container">
            <!-- Боковая панель -->
            <div class="sidebar">
                @include('yandex-direct.partials.sidebar', ['campaign' => $campaign->first()])
            </div>
            <!-- Основной контент -->
            <div class="content">
                <!-- Кнопки управления -->
                <div class="close-button-container">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="yandex_campaign_id" value="{{ $campaign->first()?->yandex_campaign_id }}">
                    <input type="hidden" name="direct_campaign_id" value="{{ $campaign->first()?->id }}">
                    <a href="{{ request()->get('back', str_replace('/campaigns/' . $campaign->first()?->id . '/settings', '', request()->url())) }}" 
                       class="btn btn-outline-secondary btn-sm" 
                       id="closeButton">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <!-- Основные настройки -->
                <div id="campaign" class="settings-section">
                    <h3 class="section-title">Основные настройки</h3>
                    @include('yandex-direct.campaigns.campaign', ['campaign' => $campaign])
                </div>

                <!-- Стратегии для поиска -->
                <div id="search_strategies" class="settings-section">
                    <h3 class="section-title">Стратегии для поиска</h3>
                    @include('yandex-direct.campaigns.searchStrategies', ['searchStrategies' => $searchStrategies])
                </div>

                <!-- Стратегии для сетей -->
                <div id="network_strategies" class="settings-section">
                    <h3 class="section-title">Стратегии для сетей</h3>
                    @include('yandex-direct.campaigns.networkStrategies', ['networkStrategies' => $networkStrategies])
                </div>

                <!-- Цели Яндекс Метрики -->
                <div id="metrics" class="settings-section">
                    <h3 class="section-title">Цели Яндекс Метрики</h3>
                    @include('yandex-direct.campaigns.metrics', ['metrics' => $metrics])
                </div>

                <!-- Расписание показов -->
                <div id="schedule" class="settings-section">
                    <h3 class="section-title">Расписание показов</h3>
                    @include('yandex-direct.campaigns.schedule', ['schedule' => $schedule])
                </div>

                <!-- Корректировки ставок -->
                <div id="bid_adjustments" class="settings-section">
                    <h3 class="section-title">Корректировки ставок</h3>
                    @include('yandex-direct.campaigns.bidAdjustments', ['bidAdjustments' => $bidAdjustments])
                </div>

                <!-- Минус слова -->
                <div id="negative_keywords" class="settings-section">
                    <h3 class="section-title">Минус слова</h3>
                    @include('yandex-direct.campaigns.negativeKeywords', ['negativeKeywords' => $negativeKeywords])
                </div>

                <!-- Площадки -->
                <div id="exclusions" class="settings-section">
                    <h3 class="section-title">Площадки</h3>
                    @include('yandex-direct.campaigns.exclusions', ['exclusions' => $exclusions])
                </div>

                <!-- Дополнительные настройки -->
                <div id="settings" class="settings-section">
                    <h3 class="section-title">Дополнительные настройки</h3>
                    @include('yandex-direct.campaigns.settings', ['settings' => $settings])
                </div>

                <!-- Панель действий -->
                @include('yandex-direct.partials.footer_actions')
            </div>
        </div>
    </div>
</form>

<!-- Подключаем скрипты из @push('scripts') -->
@stack('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    let formChanged = false;
    const form = document.getElementById('saveForm1');
    const closeButton = document.getElementById('closeButton');
    
    // Отслеживаем изменения в форме
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('change', () => {
            formChanged = true;
        });
    });

    // Обработка отправки формы сохранения
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                formChanged = false;
                // Показываем уведомление об успехе
                alert(data.message);
            } else {
                alert(data.message || 'Произошла ошибка при сохранении');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Произошла ошибка при сохранении');
        });
    });

    // Обработка клика по кнопке закрытия
    closeButton.addEventListener('click', function(e) {
        if (formChanged) {
            e.preventDefault();
            if (confirm('У вас есть несохраненные изменения. Вы уверены, что хотите покинуть страницу?')) {
                window.location.href = this.href;
            }
        }
    });

    // Предупреждение при попытке покинуть страницу
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
});
</script>
</body>
</html> 