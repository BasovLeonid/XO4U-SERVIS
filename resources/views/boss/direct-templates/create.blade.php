@extends('boss.layouts.app')

@section('title', 'Создание шаблона Яндекс.Директ')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0">Создание шаблона кампании</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
    <div class="card">
        <div class="card-body">
                    <form action="{{ route('boss.direct-templates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                        
                <div class="form-group">
                            <label for="name">Название шаблона</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                </div>

                <div class="form-group">
                    <label for="description">Описание</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                </div>

                <div class="form-group">
                            <label>Тип шаблона</label>
                            <div class="form-check">
                                <input class="form-check-input @error('types') is-invalid @enderror" 
                                       type="checkbox" name="types[]" value="search" 
                                       id="type_search" {{ in_array('search', old('types', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_search">
                                    Поиск
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('types') is-invalid @enderror" 
                                       type="checkbox" name="types[]" value="network" 
                                       id="type_network" {{ in_array('network', old('types', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_network">
                                    РСЯ
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('types') is-invalid @enderror" 
                                       type="checkbox" name="types[]" value="maps" 
                                       id="type_maps" {{ in_array('maps', old('types', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_maps">
                                    Реклама на картах
                                </label>
                            </div>
                            @error('types')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                </div>

                <div class="form-group">
                            <label for="strategy">Стратегия показа</label>
                            <input type="text" class="form-control @error('strategy') is-invalid @enderror" 
                                   id="strategy" name="strategy" value="{{ old('strategy') }}" required>
                            @error('strategy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                </div>

                <div class="form-group">
                            <label for="image">Изображение шаблона</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/jpeg,image/jpg,image/webp">
                                <label class="custom-file-label" for="image">Выберите файл</label>
                            </div>
                    <small class="form-text text-muted">
                                Поддерживаемые форматы: JPG, JPEG, WEBP. Рекомендуемый размер: 500x500 пикселей.
                    </small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Создать шаблон</button>
                            <a href="{{ route('boss.direct-templates.index') }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
                </div>
        </div>
    </div>
</div>
@endsection 

@push('scripts')
<script>
    // Обработка выбора файла
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush 