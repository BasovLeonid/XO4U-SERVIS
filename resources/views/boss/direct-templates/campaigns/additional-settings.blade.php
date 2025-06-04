@extends('boss.layouts.app')

@section('title', 'Дополнительные настройки кампании')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0">Дополнительные настройки кампании "{{ $campaign->name }}"</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('boss.direct-templates.campaigns.update', [$template, $campaign]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Здесь будут дополнительные настройки кампании -->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                            <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 