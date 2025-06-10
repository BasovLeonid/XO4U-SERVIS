<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Расписание показов</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('interface.yandex-direct.update-settings', $campaign->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Срок проведения кампании -->
            <div class="mb-4">
                <h6 class="mb-3">Срок проведения кампании</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Дата начала</label>
                            <input type="date" 
                                   class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" 
                                   name="start_date" 
                                   value="{{ old('start_date', $campaign->start_date ?? date('Y-m-d')) }}"
                                   min="{{ date('Y-m-d') }}"
                                   placeholder="{{ date('Y-m-d') }}"
                                   required>
                            <small class="form-text text-muted">Если не указана дата, будет использована текущая дата</small>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Дата окончания</label>
                            <input type="date" 
                                   class="form-control @error('end_date') is-invalid @enderror" 
                                   id="end_date" 
                                   name="end_date" 
                                   value="{{ old('end_date', $campaign->end_date) }}"
                                   min="{{ date('Y-m-d') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Расписание показов -->
            <div class="mb-4">
                <h6 class="mb-3">Расписание показов</h6>
                
                <!-- Режимы расписания -->
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="schedule_type" id="schedule_type_1" value="everyday" {{ old('schedule_type', $campaign->schedule_type ?? 'everyday') == 'everyday' ? 'checked' : '' }}>
                        <label class="form-check-label" for="schedule_type_1">Каждый день, круглосуточно</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="schedule_type" id="schedule_type_2" value="workdays" {{ old('schedule_type') == 'workdays' ? 'checked' : '' }}>
                        <label class="form-check-label" for="schedule_type_2">По будням</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="schedule_type" id="schedule_type_3" value="custom" {{ old('schedule_type') == 'custom' ? 'checked' : '' }}>
                        <label class="form-check-label" for="schedule_type_3">Почасовая настройка</label>
                    </div>
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
                </div>

                <!-- Почасовая настройка -->
                <div id="custom_schedule" style="display: none;">
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="enable_bid_adjustment" name="enable_bid_adjustment">
                            <label class="form-check-label" for="enable_bid_adjustment">Корректировка ставок</label>
                        </div>
                        
                        <div id="bid_adjustment_settings" style="display: none;" class="mt-2">
                            <select class="form-select" id="bid_adjustment_value">
                                <option value="0">0% - показы отключены</option>
                                @for($i = 10; $i <= 200; $i += 10)
                                    <option value="{{ $i }}">{{ $i }}%</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="schedule-grid">
                        <div class="schedule-header">
                            <div class="day-label"></div>
                            @for($hour = 0; $hour < 24; $hour++)
                                <div class="hour-label" data-hour="{{ $hour }}">{{ $hour }}</div>
                            @endfor
                        </div>
                        @foreach(['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'] as $index => $day)
                            <div class="schedule-row" data-day="{{ $index + 1 }}">
                                <div class="day-label" data-day="{{ $index + 1 }}">{{ $day }}</div>
                                @for($hour = 0; $hour < 24; $hour++)
                                    <div class="hour-cell" 
                                         data-day="{{ $index + 1 }}" 
                                         data-hour="{{ $hour }}"
                                         data-value="100">
                                        <span class="bid-value">100</span>
                                    </div>
                                @endfor
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Общие настройки -->
                <div class="mt-4">
                    <div class="mb-3">
                        <h6>В рабочие выходные</h6>
                        <select class="form-select" id="consider_working_weekends" name="consider_working_weekends">
                            <option value="YES" {{ old('consider_working_weekends', $campaign->consider_working_weekends ?? 'YES') == 'YES' ? 'selected' : '' }}>
                                По расписанию рабочего дня, перенесенного на выходной
                            </option>
                            <option value="NO" {{ old('consider_working_weekends') == 'NO' ? 'selected' : '' }}>
                                По расписанию выходного дня
                            </option>
                        </select>
                        <small class="form-text text-muted">
                            Например, если рабочий день перенесен с понедельника на субботу, при значении "По расписанию рабочего дня" в рабочую субботу пойдут показы по расписанию понедельника, а в нерабочий понедельник — по расписанию субботы.
                        </small>
                    </div>

                    <div class="mb-3">
                        <h6>Показы в праздничные дни</h6>
                        <select class="form-select" id="holiday_show_type" name="holiday_show_type">
                            <option value="schedule" {{ old('holiday_show_type', $campaign->holiday_show_type ?? 'schedule') == 'schedule' ? 'selected' : '' }}>
                                По расписанию соответствующего дня недели
                            </option>
                            <option value="suspend" {{ old('holiday_show_type') == 'suspend' ? 'selected' : '' }}>
                                Не показывать
                            </option>
                            <option value="custom" {{ old('holiday_show_type') == 'custom' ? 'selected' : '' }}>
                                Настроить интервал вручную
                            </option>
                        </select>

                        <div id="holiday_settings" class="mt-3" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="holiday_bid_percent" class="form-label">Коэффициент ставки</label>
                                    <select class="form-select" id="holiday_bid_percent" name="holiday_bid_percent">
                                        @for($i = 10; $i <= 200; $i += 10)
                                            <option value="{{ $i }}" {{ old('holiday_bid_percent', $campaign->holiday_bid_percent ?? 100) == $i ? 'selected' : '' }}>{{ $i }}%</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="holiday_start_hour" class="form-label">Время начала</label>
                                    <select class="form-select" id="holiday_start_hour" name="holiday_start_hour">
                                        @for($i = 0; $i < 24; $i++)
                                            <option value="{{ $i }}" {{ old('holiday_start_hour', $campaign->holiday_start_hour ?? 0) == $i ? 'selected' : '' }}>{{ $i }}:00</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="holiday_end_hour" class="form-label">Время окончания</label>
                                    <select class="form-select" id="holiday_end_hour" name="holiday_end_hour">
                                        @for($i = 1; $i <= 24; $i++)
                                            <option value="{{ $i }}" {{ old('holiday_end_hour', $campaign->holiday_end_hour ?? 24) == $i ? 'selected' : '' }}>{{ $i }}:00</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('interface.yandex-direct.settings', $campaign->id) }}?type=template&id_template={{ $campaign->template_id }}&back={{ urlencode(request()->get('back')) }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
.schedule-grid {
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    overflow: hidden;
}

.schedule-header {
    display: flex;
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.schedule-row {
    display: flex;
    border-bottom: 1px solid #dee2e6;
}

.schedule-row:last-child {
    border-bottom: none;
}

.day-label {
    width: 60px;
    padding: 0.5rem;
    text-align: center;
    font-weight: 500;
    background-color: #f8f9fa;
    border-right: 1px solid #dee2e6;
    cursor: pointer;
    transition: background-color 0.2s;
}

.day-label.active {
    background-color: #28a745;
    color: white;
}

.hour-label {
    flex: 1;
    padding: 0.5rem;
    text-align: center;
    font-size: 0.875rem;
    border-right: 1px solid #dee2e6;
    cursor: pointer;
    transition: background-color 0.2s;
}

.hour-label.active {
    background-color: #28a745;
    color: white;
}

.hour-label:last-child {
    border-right: none;
}

.hour-cell {
    flex: 1;
    padding: 0.5rem;
    text-align: center;
    cursor: pointer;
    border-right: 1px solid #dee2e6;
    transition: background-color 0.2s;
}

.hour-cell:last-child {
    border-right: none;
}

.hour-cell.inactive {
    background-color: #6c757d;
    color: white;
}

.hour-cell:hover {
    opacity: 0.8;
}

.bid-value {
    font-size: 0.875rem;
}

/* Цвета для корректировок ставок */
.bid-0 {
    background-color: #6c757d;
    color: white;
}

.bid-10 { background-color: #e8f5e9; }
.bid-20 { background-color: #c8e6c9; }
.bid-30 { background-color: #a5d6a7; }
.bid-40 { background-color: #81c784; }
.bid-50 { background-color: #66bb6a; }
.bid-60 { background-color: #4caf50; }
.bid-70 { background-color: #43a047; }
.bid-80 { background-color: #388e3c; }
.bid-90 { background-color: #2e7d32; }
.bid-100 { background-color: #28a745; }

.bid-110 { background-color: #fff9c4; }
.bid-120 { background-color: #fff59d; }
.bid-130 { background-color: #fff176; }
.bid-140 { background-color: #ffee58; }
.bid-150 { background-color: #ffeb3b; }

.bid-160 { background-color: #ffcdd2; }
.bid-170 { background-color: #ef9a9a; }
.bid-180 { background-color: #e57373; }
.bid-190 { background-color: #ef5350; }
.bid-200 { background-color: #f44336; }

/* Стили для выпадающего списка корректировок */
#bid_adjustment_value option {
    padding: 5px;
}

#bid_adjustment_value option[value="0"] {
    background-color: #6c757d;
    color: white;
}

#bid_adjustment_value option[value^="1"] {
    background-color: #e8f5e9;
}

#bid_adjustment_value option[value^="2"] {
    background-color: #c8e6c9;
}

#bid_adjustment_value option[value^="3"] {
    background-color: #a5d6a7;
}

#bid_adjustment_value option[value^="4"] {
    background-color: #81c784;
}

#bid_adjustment_value option[value^="5"] {
    background-color: #66bb6a;
}

#bid_adjustment_value option[value^="6"] {
    background-color: #4caf50;
}

#bid_adjustment_value option[value^="7"] {
    background-color: #43a047;
}

#bid_adjustment_value option[value^="8"] {
    background-color: #388e3c;
}

#bid_adjustment_value option[value^="9"] {
    background-color: #2e7d32;
}

#bid_adjustment_value option[value="100"] {
    background-color: #28a745;
}

#bid_adjustment_value option[value^="11"] {
    background-color: #fff9c4;
}

#bid_adjustment_value option[value^="12"] {
    background-color: #fff59d;
}

#bid_adjustment_value option[value^="13"] {
    background-color: #fff176;
}

#bid_adjustment_value option[value^="14"] {
    background-color: #ffee58;
}

#bid_adjustment_value option[value="150"] {
    background-color: #ffeb3b;
}

#bid_adjustment_value option[value^="16"] {
    background-color: #ffcdd2;
}

#bid_adjustment_value option[value^="17"] {
    background-color: #ef9a9a;
}

#bid_adjustment_value option[value^="18"] {
    background-color: #e57373;
}

#bid_adjustment_value option[value^="19"] {
    background-color: #ef5350;
}

#bid_adjustment_value option[value="200"] {
    background-color: #f44336;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработка переключения режимов расписания
    const scheduleTypes = document.querySelectorAll('input[name="schedule_type"]');
    const workdaysSettings = document.getElementById('workdays_settings');
    const customSchedule = document.getElementById('custom_schedule');

    scheduleTypes.forEach(type => {
        type.addEventListener('change', function() {
            workdaysSettings.style.display = this.value === 'workdays' ? 'block' : 'none';
            customSchedule.style.display = this.value === 'custom' ? 'block' : 'none';
        });
    });

    // Обработка корректировки ставок
    const enableBidAdjustment = document.getElementById('enable_bid_adjustment');
    const bidAdjustmentSettings = document.getElementById('bid_adjustment_settings');
    const bidAdjustmentValue = document.getElementById('bid_adjustment_value');

    enableBidAdjustment.addEventListener('change', function() {
        bidAdjustmentSettings.style.display = this.checked ? 'block' : 'none';
    });

    // Обработка типа показа в праздничные дни
    const holidayShowType = document.getElementById('holiday_show_type');
    const holidaySettings = document.getElementById('holiday_settings');

    holidayShowType.addEventListener('change', function() {
        holidaySettings.style.display = this.value === 'custom' ? 'block' : 'none';
    });

    // Инициализация видимости настроек праздничных дней
    if (holidayShowType.value === 'custom') {
        holidaySettings.style.display = 'block';
    }

    // Функция для обновления цвета ячейки
    function updateCellColor(cell, value) {
        cell.className = 'hour-cell';
        if (value === '0') {
            cell.classList.add('inactive');
        } else {
            cell.classList.add(`bid-${value}`);
        }
        cell.dataset.value = value;
        cell.querySelector('.bid-value').textContent = value;
    }

    // Функция для обновления цвета строки дня
    function updateDayRowColor(dayIndex) {
        const row = document.querySelector(`.schedule-row[data-day="${dayIndex + 1}"]`);
        if (!row) return;
        
        const cells = row.querySelectorAll('.hour-cell');
        const allActive = Array.from(cells).every(cell => cell.dataset.value !== '0');
        const dayLabel = row.querySelector('.day-label');
        
        if (allActive) {
            dayLabel.classList.add('active');
        } else {
            dayLabel.classList.remove('active');
        }
    }

    // Функция для обновления цвета столбца часа
    function updateHourColumnColor(hourIndex) {
        const cells = document.querySelectorAll(`.hour-cell[data-hour="${hourIndex}"]`);
        const allActive = Array.from(cells).every(cell => cell.dataset.value !== '0');
        const hourLabel = document.querySelector(`.hour-label[data-hour="${hourIndex}"]`);
        
        if (allActive) {
            hourLabel.classList.add('active');
        } else {
            hourLabel.classList.remove('active');
        }
    }

    // Обработка кликов по ячейкам расписания
    document.querySelectorAll('.hour-cell').forEach(cell => {
        cell.addEventListener('click', function() {
            const currentValue = this.dataset.value;
            let newValue;
            
            if (enableBidAdjustment.checked) {
                newValue = bidAdjustmentValue.value;
            } else {
                newValue = currentValue === '100' ? '0' : '100';
            }
            
            updateCellColor(this, newValue);
            updateDayRowColor(parseInt(this.dataset.day) - 1);
            updateHourColumnColor(parseInt(this.dataset.hour));
        });
    });

    // Обработка кликов по дням
    document.querySelectorAll('.day-label[data-day]').forEach((label) => {
        label.addEventListener('click', function() {
            const dayIndex = parseInt(this.dataset.day) - 1;
            const row = document.querySelector(`.schedule-row[data-day="${dayIndex + 1}"]`);
            const cells = row.querySelectorAll('.hour-cell');
            const allActive = Array.from(cells).every(cell => cell.dataset.value !== '0');
            const newValue = allActive ? '0' : (enableBidAdjustment.checked ? bidAdjustmentValue.value : '100');
            
            cells.forEach(cell => {
                updateCellColor(cell, newValue);
                updateHourColumnColor(parseInt(cell.dataset.hour));
            });
            
            updateDayRowColor(dayIndex);
        });
    });

    // Обработка кликов по часам
    document.querySelectorAll('.hour-label[data-hour]').forEach((label) => {
        label.addEventListener('click', function() {
            const hourIndex = parseInt(this.dataset.hour);
            const cells = document.querySelectorAll(`.hour-cell[data-hour="${hourIndex}"]`);
            const allActive = Array.from(cells).every(cell => cell.dataset.value !== '0');
            const newValue = allActive ? '0' : (enableBidAdjustment.checked ? bidAdjustmentValue.value : '100');
            
            cells.forEach(cell => {
                updateCellColor(cell, newValue);
                updateDayRowColor(parseInt(cell.dataset.day) - 1);
            });
            
            updateHourColumnColor(hourIndex);
        });
    });

    // Инициализация цветов при загрузке
    document.querySelectorAll('.hour-cell').forEach(cell => {
        updateCellColor(cell, cell.dataset.value);
    });

    for (let i = 0; i < 7; i++) {
        updateDayRowColor(i);
    }

    for (let i = 0; i < 24; i++) {
        updateHourColumnColor(i);
    }
});
</script>
@endpush 