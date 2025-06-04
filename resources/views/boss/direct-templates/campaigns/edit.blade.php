@extends('boss.layouts.app')

@section('title', 'Редактирование кампании')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Редактирование кампании "{{ $campaign->name }}"</h1>
            <div>
                <a href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaign]) }}" class="btn btn-info me-2">
                    <i class="fas fa-sliders-h me-1"></i>Дополнительные настройки
                </a>
                <a href="{{ route('boss.direct-templates.campaigns.limits', [$template, $campaign]) }}" class="btn btn-warning me-2">
                    <i class="fas fa-ban me-1"></i>Ограничения
                </a>
                <form action="{{ route('boss.direct-templates.campaigns.destroy', [$template, $campaign]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту кампанию?')">
                        <i class="fas fa-trash me-1"></i>Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST">
                @csrf
                @method('PUT')

                <x-yandex-direct.campaigns.basic-settings :campaign="$campaign" />
                
                <x-yandex-direct.campaigns.advanced-settings 
                    :campaign="$campaign"
                    :counters="$counters"
                    :goals="$goals" />

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-secondary">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 