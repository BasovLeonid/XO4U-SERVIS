@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Создание шаблона сайта</h3>
                    <div class="card-tools">
                        <a href="{{ route('boss.site-templates.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Назад к списку
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('boss.site-templates.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Название шаблона <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required
                                   placeholder="Введите название шаблона">
                            <small class="form-text text-muted">
                                Название будет отображаться в списке шаблонов и при выборе шаблона
                            </small>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="template_code">Код шаблона <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('template_code') is-invalid @enderror" 
                                   id="template_code" 
                                   name="template_code" 
                                   value="{{ old('template_code') }}" 
                                   required
                                   placeholder="Код будет сгенерирован автоматически"
                                   readonly>
                            <small class="form-text text-muted">
                                Код шаблона генерируется автоматически из названия и используется для идентификации шаблона в системе
                            </small>
                            @error('template_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3"
                                      placeholder="Опишите особенности и назначение шаблона">{{ old('description') }}</textarea>
                            <small class="form-text text-muted">
                                Описание поможет другим пользователям понять назначение и особенности шаблона
                            </small>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="preview_image">Превью шаблона <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('preview_image') is-invalid @enderror" 
                                       id="preview_image" 
                                       name="preview_image" 
                                       accept="image/jpeg,image/jpg,image/webp"
                                       required>
                                <label class="custom-file-label" for="preview_image">Выберите файл</label>
                            </div>
                            <small class="form-text text-muted">
                                Требования к изображению:
                                <ul>
                                    <li>Размер: 640x360 пикселей</li>
                                    <li>Формат: JPG, JPEG или WEBP</li>
                                    <li>Максимальный размер файла: 250KB</li>
                                </ul>
                            </small>
                            @error('preview_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="template_zip">Архив шаблона <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('template_zip') is-invalid @enderror" 
                                       id="template_zip" 
                                       name="template_zip" 
                                       accept=".zip"
                                       required>
                                <label class="custom-file-label" for="template_zip">Выберите файл</label>
                            </div>
                            <small class="form-text text-muted">
                                Требования к архиву:
                                <ul>
                                    <li>Формат: ZIP</li>
                                    <li>Максимальный размер: 50MB</li>
                                    <li>В корне архива должен находиться файл template.blade.php</li>
                                    <li>Все файлы шаблона должны быть в корне архива</li>
                                </ul>
                            </small>
                            @error('template_zip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Создать шаблон
                            </button>
                            <a href="{{ route('boss.site-templates.index') }}" class="btn btn-default">
                                <i class="fas fa-times"></i> Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Обновление имени файла в label при выборе
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    });

    // Автогенерация кода шаблона из названия
    document.getElementById('name').addEventListener('input', function(e) {
        var name = e.target.value;
        var code = name
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Удаляем все кроме букв, цифр, пробелов и дефисов
            .replace(/\s+/g, '_') // Заменяем пробелы на подчеркивания
            .replace(/-+/g, '_') // Заменяем множественные дефисы на один
            .replace(/^_+|_+$/g, ''); // Удаляем подчеркивания в начале и конце
        
        document.getElementById('template_code').value = code;
    });
</script>
@endpush
@endsection 