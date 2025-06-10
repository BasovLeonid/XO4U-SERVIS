@extends('boss.layouts.app')

@section('title', 'Просмотр шаблона Яндекс.Директ')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Просмотр шаблона: {{ $template->name }}</h1>
            <div>
                <a href="{{ route('boss.direct-templates.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Назад к списку
                </a>
                <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Редактировать
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($template->image)
                                <img src="{{ Storage::url($template->image) }}" alt="{{ $template->name }}" class="img-fluid rounded mb-3">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">Основная информация</h4>
                            <table class="table">
                                <tr>
                                    <th style="width: 200px;">Название:</th>
                                    <td>{{ $template->name }}</td>
                                </tr>
                                <tr>
                                    <th>Описание:</th>
                                    <td>{{ $template->description }}</td>
                                </tr>
                                <tr>
                                    <th>Типы:</th>
                                    <td>
                                        @foreach($template->types as $type)
                                            <span class="badge bg-info">{{ $type }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>Стратегия:</th>
                                    <td>{{ $template->strategy }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Связанные кампании</h4>
                                <div>
                                    <a href="{{ route('interface.yandex-direct.create') }}?type=template&id_template={{ $template->id }}&back={{ urlencode(url()->current()) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i>Создать кампанию
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Название кампании</th>
                                            <th>Статус</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $templateCampaigns = $campaigns->where('template_id', $template->id);
                                        @endphp
                                        @forelse($templateCampaigns as $campaign)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('interface.yandex-direct.settings', $campaign->id) }}?type=template&id_template={{ $template->id }}&back={{ urlencode(url()->current()) }}" class="text-decoration-none">
                                                        <i class="fas fa-ad me-1"></i>
                                                        {{ $campaign->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($campaign->status)
                                                        <span class="badge bg-{{ $campaign->status === 'active' ? 'success' : 'secondary' }}">
                                                            {{ $campaign->status }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('interface.yandex-direct.destroy', $campaign->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить кампанию?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Нет связанных кампаний</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 