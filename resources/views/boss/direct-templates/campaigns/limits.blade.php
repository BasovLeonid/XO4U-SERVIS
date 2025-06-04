@extends('boss.layouts.app')

@section('title', 'Ограничения кампании')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Ограничения кампании "{{ $campaign->name }}"</h1>
            <div>
                <a href="{{ route('boss.direct-templates.campaigns.edit', [$template, $campaign]) }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i>Назад к редактированию
                </a>
                <a href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaign]) }}" class="btn btn-info">
                    <i class="fas fa-sliders-h me-1"></i>Дополнительные настройки
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="weekly_spend_limit">Недельный лимит расходов</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" class="form-control" 
                                       id="weekly_spend_limit" name="weekly_spend_limit" 
                                       value="{{ old('weekly_spend_limit', $campaign->weekly_spend_limit) }}">
                                <span class="input-group-text">₽</span>
                            </div>
                            <small class="form-text text-muted">
                                Максимальная сумма расходов за неделю. Оставьте пустым для отключения ограничения.
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="average_cpc">Средняя стоимость клика</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" class="form-control" 
                                       id="average_cpc" name="average_cpc" 
                                       value="{{ old('average_cpc', $campaign->average_cpc) }}">
                                <span class="input-group-text">₽</span>
                            </div>
                            <small class="form-text text-muted">
                                Ожидаемая средняя стоимость клика. Используется для прогнозирования расходов.
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="average_cpa">Средняя стоимость конверсии</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" class="form-control" 
                                       id="average_cpa" name="average_cpa" 
                                       value="{{ old('average_cpa', $campaign->average_cpa) }}">
                                <span class="input-group-text">₽</span>
                            </div>
                            <small class="form-text text-muted">
                                Ожидаемая средняя стоимость конверсии. Используется для прогнозирования расходов.
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="average_crr">Средний коэффициент конверсии</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" max="100" class="form-control" 
                                       id="average_crr" name="average_crr" 
                                       value="{{ old('average_crr', $campaign->average_crr) }}">
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="form-text text-muted">
                                Ожидаемый средний коэффициент конверсии. Используется для прогнозирования конверсий.
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cpa">Целевая стоимость конверсии</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" class="form-control" 
                                       id="cpa" name="cpa" 
                                       value="{{ old('cpa', $campaign->cpa) }}">
                                <span class="input-group-text">₽</span>
                            </div>
                            <small class="form-text text-muted">
                                Максимальная допустимая стоимость конверсии. Используется для оптимизации кампании.
                            </small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="crr">Целевой коэффициент конверсии</label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="0" max="100" class="form-control" 
                                       id="crr" name="crr" 
                                       value="{{ old('crr', $campaign->crr) }}">
                                <span class="input-group-text">%</span>
                            </div>
                            <small class="form-text text-muted">
                                Минимальный допустимый коэффициент конверсии. Используется для оптимизации кампании.
                            </small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Сохранить ограничения</button>
                            <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 