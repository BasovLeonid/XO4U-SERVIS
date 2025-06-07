@props([
    'campaign' => null,
    'counters' => [],
    'goals' => [],
    'template' => null
])

@push('styles')
<style>
@include('yandex-direct.partials.styles')
</style>
@endpush

<div class="yandex-direct-interface">
    <div class="interface-container">
        <!-- Боковая панель -->
        <div class="sidebar">
            @include('yandex-direct.partials.sidebar', ['campaign' => $campaign])
        </div>

        <!-- Основной контент -->
        <div class="content">
            <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST" id="campaignSettingsForm">
                @csrf
                @method('PUT')

                <!-- Базовые настройки -->
                <div id="basic" class="settings-section">
                    <h3 class="section-title">Основные настройки</h3>
                    @include('yandex-direct.campaigns.basic_settings', ['campaign' => $campaign])
                </div>

                <!-- Расширенные настройки -->
                <div id="advanced" class="settings-section">
                    <h3 class="section-title">Расширенные настройки</h3>
                    @include('yandex-direct.campaigns.advanced_settings', [
                        'campaign' => $campaign,
                        'counters' => $counters,
                        'goals' => $goals
                    ])
                </div>
                
                <!-- Расписание -->
                <div id="schedule" class="settings-section">
                    <h3 class="section-title">Расписание показов</h3>
                    @include('yandex-direct.campaigns.schedule', ['campaign' => $campaign])
                </div>

                <!-- Корректировки -->
                <div id="corrections" class="settings-section">
                    <h3 class="section-title">Корректировки ставок</h3>
                    @include('yandex-direct.campaigns.corrections', ['campaign' => $campaign])
                </div>

                <!-- Ограничения -->
                <div id="restrictions" class="settings-section">
                    <h3 class="section-title">Минус-фразы</h3>
                    @include('yandex-direct.campaigns.restrictions', ['campaign' => $campaign])
                </div>

                <!-- Дополнительные настройки -->
                <div id="additional" class="settings-section">
                    <h3 class="section-title">Параметры URL</h3>
                    @include('yandex-direct.campaigns.additional-settings', ['campaign' => $campaign])
                </div>

                <!-- Кнопки управления -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Сохранить изменения
                    </button>
                    <a href="{{ route('boss.direct-templates.campaigns.show', [$template, $campaign]) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Только общая обработка формы
    const form = document.getElementById('campaignSettingsForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect || form.action;
                } else {
                    alert(data.message || 'Произошла ошибка при сохранении настроек');
                }
            })
            .catch(error => {
                alert('Ошибка: ' + error.message);
            });
        });
    }
});
</script>
@endpush 