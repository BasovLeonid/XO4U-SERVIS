@extends('boss.layouts.app')

@section('title', 'Шаблоны Яндекс.Директ')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Шаблоны Яндекс.Директ</h1>
            <a href="{{ route('boss.direct-templates.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Создать шаблон
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Описание</th>
                                    <th>Типы</th>
                                    <th>Стратегия</th>
                                    <th>Кампании</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $template)
                                    <tr>
                                        <td>
                                            @if($template->image)
                                                <img src="{{ Storage::url($template->image) }}" alt="{{ $template->name }}" class="img-thumbnail" style="max-width: 50px; margin-right: 10px;">
                                            @endif
                                            {{ $template->name }}
                                        </td>
                                        <td>{{ Str::limit($template->description, 100) }}</td>
                                        <td>
                                            @foreach($template->types as $type)
                                                <span class="badge bg-info">{{ $type }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $template->strategy }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @php
                                                    $templateCampaigns = $campaigns->where('template_id', $template->id);
                                                @endphp
                                                @forelse($templateCampaigns as $campaign)
                                                    <div class="mb-1">
                                                        <span class="text-muted">
                                                            <i class="fas fa-ad me-1"></i>{{ $campaign->name }}
                                                            @if($campaign->status)
                                                                <span class="badge bg-{{ $campaign->status === 'active' ? 'success' : 'secondary' }}">
                                                                    {{ $campaign->status }}
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                @empty
                                                    <span class="text-muted">Нет связанных кампаний</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('boss.direct-templates.destroy', $template) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить шаблон?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Шаблоны не найдены</td>
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
@endsection 