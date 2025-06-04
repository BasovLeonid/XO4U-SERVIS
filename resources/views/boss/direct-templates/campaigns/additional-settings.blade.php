@extends('boss.layouts.app')

@section('title', 'Дополнительные настройки кампании')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Дополнительные настройки кампании "{{ $campaign->name }}"</h1>
            <div>
                <a href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaign]) }}" class="btn btn-info me-2">
                    <i class="fas fa-sliders-h me-1"></i>Основные настройки
                </a>
                <a href="{{ route('boss.direct-templates.campaigns.limits', [$template, $campaign]) }}" class="btn btn-warning me-2">
                    <i class="fas fa-ban me-1"></i>Ограничения
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Расписание показа</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_targeting_schedule">Расписание показа</label>
                                    <select class="form-control" id="time_targeting_schedule" name="time_targeting_schedule[]" multiple>
                                        <option value="monday">Понедельник</option>
                                        <option value="tuesday">Вторник</option>
                                        <option value="wednesday">Среда</option>
                                        <option value="thursday">Четверг</option>
                                        <option value="friday">Пятница</option>
                                        <option value="saturday">Суббота</option>
                                        <option value="sunday">Воскресенье</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="consider_working_weekends">Учитывать рабочие выходные</label>
                                    <select class="form-control" id="consider_working_weekends" name="consider_working_weekends">
                                        <option value="YES">Да</option>
                                        <option value="NO">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Параметры URL</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tracking_params">Параметры отслеживания</label>
                            <textarea class="form-control" id="tracking_params" name="tracking_params" rows="3" placeholder="Введите параметры в формате: utm_source=source&utm_medium=medium&utm_campaign=campaign"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Настройки уведомлений</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sms_settings">SMS-уведомления</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sms_campaign_stopped" name="sms_settings[events][]" value="CAMPAIGN_STOPPED">
                                        <label class="form-check-label" for="sms_campaign_stopped">
                                            Остановка кампании
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sms_campaign_ended" name="sms_settings[events][]" value="CAMPAIGN_ENDED">
                                        <label class="form-check-label" for="sms_campaign_ended">
                                            Завершение кампании
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_settings">Email-уведомления</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="email_campaign_stopped" name="email_settings[events][]" value="CAMPAIGN_STOPPED">
                                        <label class="form-check-label" for="email_campaign_stopped">
                                            Остановка кампании
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="email_campaign_ended" name="email_settings[events][]" value="CAMPAIGN_ENDED">
                                        <label class="form-check-label" for="email_campaign_ended">
                                            Завершение кампании
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Списки</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="negative_keywords">Минус-слова</label>
                                    <textarea class="form-control" id="negative_keywords" name="negative_keywords[]" rows="3" placeholder="Введите минус-слова, каждое с новой строки"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="blocked_ips">Заблокированные IP</label>
                                    <textarea class="form-control" id="blocked_ips" name="blocked_ips[]" rows="3" placeholder="Введите IP-адреса, каждый с новой строки"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="excluded_sites">Исключенные сайты</label>
                                    <textarea class="form-control" id="excluded_sites" name="excluded_sites[]" rows="3" placeholder="Введите URL сайтов, каждый с новой строки"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Сохранить изменения
                    </button>
                    <a href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaign]) }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Инициализация Select2 для множественного выбора
        $('#time_targeting_schedule').select2({
            placeholder: 'Выберите дни недели',
            allowClear: true
        });

        // Загрузка текущих значений
        @if($campaign->time_targeting_schedule)
            $('#time_targeting_schedule').val(@json($campaign->time_targeting_schedule)).trigger('change');
        @endif

        @if($campaign->consider_working_weekends)
            $('#consider_working_weekends').val('{{ $campaign->consider_working_weekends }}');
        @endif

        @if($campaign->tracking_params)
            $('#tracking_params').val('{{ $campaign->tracking_params }}');
        @endif

        @if($campaign->sms_settings)
            @foreach($campaign->sms_settings['events'] as $event)
                $('#sms_{{ strtolower($event) }}').prop('checked', true);
            @endforeach
        @endif

        @if($campaign->email_settings)
            @foreach($campaign->email_settings['events'] as $event)
                $('#email_{{ strtolower($event) }}').prop('checked', true);
            @endforeach
        @endif

        @if($campaign->negative_keywords)
            $('#negative_keywords').val(@json($campaign->negative_keywords).join('\n'));
        @endif

        @if($campaign->blocked_ips)
            $('#blocked_ips').val(@json($campaign->blocked_ips).join('\n'));
        @endif

        @if($campaign->excluded_sites)
            $('#excluded_sites').val(@json($campaign->excluded_sites).join('\n'));
        @endif
    });
</script>
@endpush
@endsection 