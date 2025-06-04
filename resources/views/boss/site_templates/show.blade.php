@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Просмотр шаблона: {{ $template->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('boss.site-templates.edit', $template) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Редактировать
                        </a>
                        <a href="{{ route('boss.site-templates.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Назад к списку
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="preview-container mb-4">
                                @if($template->preview_image)
                                    <img src="{{ Storage::url($template->preview_image) }}" 
                                         class="img-fluid rounded" 
                                         alt="{{ $template->name }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Информация о шаблоне</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th style="width: 200px;">Название</th>
                                            <td>{{ $template->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Код шаблона</th>
                                            <td>{{ $template->template_code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Статус</th>
                                            <td>
                                                <span class="badge badge-{{ $template->status === 'active' ? 'success' : ($template->status === 'draft' ? 'warning' : 'secondary') }}">
                                                    {{ $template->status === 'active' ? 'Активный' : ($template->status === 'draft' ? 'Черновик' : 'Архивный') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Описание</th>
                                            <td>{{ $template->description ?: 'Нет описания' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Создан</th>
                                            <td>{{ $template->created_at->format('d.m.Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Обновлен</th>
                                            <td>{{ $template->updated_at->format('d.m.Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Блоки шаблона</h4>
                                </div>
                                <div class="card-body">
                                    @if($template->blocks->count() > 0)
                                        <ul class="list-group">
                                            @foreach($template->blocks as $block)
                                                <li class="list-group-item">
                                                    <h5 class="mb-1">{{ $block->name }}</h5>
                                                    <p class="mb-1 text-muted">{{ $block->description }}</p>
                                                    <small class="text-muted">Код: {{ $block->block_code }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-info">
                                            Блоки не найдены
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-header">
                                    <h4 class="card-title">Переменные шаблона</h4>
                                </div>
                                <div class="card-body">
                                    @if($template->variables->count() > 0)
                                        <ul class="list-group">
                                            @foreach($template->variables as $variable)
                                                <li class="list-group-item">
                                                    <h5 class="mb-1">{{ $variable->name }}</h5>
                                                    <p class="mb-1 text-muted">{{ $variable->description }}</p>
                                                    <small class="text-muted">Код: {{ $variable->variable_code }}</small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-info">
                                            Переменные не найдены
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .preview-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* Соотношение 16:9 (360/640 = 0.5625) */
        background-color: #f8f9fa;
        overflow: hidden;
    }
    .preview-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
    }
    .preview-container .bg-light {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush
@endsection 