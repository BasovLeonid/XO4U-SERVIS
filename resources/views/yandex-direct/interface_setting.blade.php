<!DOCTYPE html>
<html lang="ru">
<head>
    @include('yandex-direct.partials.head')
    <style>
        @include('yandex-direct.partials.styles')
    </style>
</head>
<body>
<form id="saveForm1" action="{{ route('interface.yandex-direct.update-settings', ['campaign' => $campaign->id]) }}" method="POST" class="d-inline">
    <div class="yandex-direct-interface">
        <div class="interface-container">
            <!-- Боковая панель -->
            <div class="sidebar">
                @include('yandex-direct.partials.sidebar', ['campaign' => $campaign])
            </div>

            <!-- Основной контент -->
            <div class="content">
                <!-- Кнопки управления -->
                <div class="close-button-container">
                    
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="yandex_campaign_id" value="{{ $campaign->yandex_campaign_id }}">
                        <input type="hidden" name="direct_campaign_id" value="{{ $campaign->id }}">
                        <button type="submit" class="btn btn-primary btn-sm me-2" id="saveButton1">
                            <i class="fas fa-save"></i> Сохранить
                        </button>
                    
                    <a href="{{ request()->get('back', str_replace('/campaigns/' . $campaign->id . '/settings', '', request()->url())) }}" 
                       class="btn btn-outline-secondary btn-sm" 
                       id="closeButton">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <!-- Базовые настройки -->
                <div id="basic" class="settings-section">
                    <h3 class="section-title">Основные настройки</h3>
                    @include('yandex-direct.campaigns.basic_settings', ['campaign' => $campaign])
                </div>

                @php 
                $counters = 0; 
                $goals = [];
                @endphp

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
            </div>
        </div>
    </div>
    </form>
    <!-- Подключаем скрипты из @push('scripts') -->
    @stack('scripts')
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let formChanged = false;
            const forms = document.querySelectorAll('form');
            const closeButton = document.getElementById('closeButton');
            const saveForm = document.getElementById('saveForm');
            
            // Отслеживаем изменения в формах
            forms.forEach(form => {
                const inputs = form.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.addEventListener('change', () => {
                        formChanged = true;
                    });
                });
            });

            // Обработка отправки формы сохранения
            saveForm.addEventListener('submit', function(e) {
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
                        alert('Настройки успешно сохранены');
                    } else {
                        alert('Произошла ошибка при сохранении');
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