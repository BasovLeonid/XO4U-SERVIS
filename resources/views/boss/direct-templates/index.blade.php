@extends('boss.layouts.app')

@section('title', 'Шаблоны Яндекс.Директ')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Шаблоны кампаний Яндекс Директ</h1>
            <a href="{{ route('boss.direct-templates.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i>Добавить шаблон
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Типы</th>
                        <th>Стратегия</th>
                        <th>Кампаний</th>
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
                            <td>{{ $template->campaigns->count() }}</td>
                        <td>
                                <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-sm btn-warning mr-1">
                                <i class="fas fa-edit"></i> Редактировать
                            </a>
                                <form action="{{ route('boss.direct-templates.destroy', $template) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить шаблон?')">
                                    <i class="fas fa-trash"></i> Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Нет шаблонов кампаний</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 