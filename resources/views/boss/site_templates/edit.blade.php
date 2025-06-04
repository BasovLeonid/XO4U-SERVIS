@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Редактирование шаблона</h3>
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

                    <form action="{{ route('boss.site-templates.update', $template) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Название шаблона <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $template->name) }}" 
                                   required
                                   placeholder="Введите название шаблона">
                            <small class="form-text text-muted">
                                Название будет отображаться в списке шаблонов и при выборе шаблона. 
                                Рекомендуется использовать понятное и описательное название.
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
                                   value="{{ old('template_code', $template->template_code) }}" 
                                   required
                                   pattern="[a-z0-9_]+"
                                   title="Только латинские буквы, цифры и подчеркивания"
                                   placeholder="Например: landing_page_1">
                            <small class="form-text text-muted">
                                Код шаблона используется для идентификации в системе. 
                                Допустимы только латинские буквы, цифры и подчеркивания. 
                                Не используйте пробелы и специальные символы.
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
                                      placeholder="Опишите особенности и назначение шаблона">{{ old('description', $template->description) }}</textarea>
                            <small class="form-text text-muted">
                                Подробное описание поможет другим пользователям понять назначение и особенности шаблона. 
                                Укажите основные функции, особенности дизайна и целевую аудиторию.
                            </small>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Статус <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status', $template->status) == 'active' ? 'selected' : '' }}>Активный</option>
                                <option value="draft" {{ old('status', $template->status) == 'draft' ? 'selected' : '' }}>Черновик</option>
                                <option value="archived" {{ old('status', $template->status) == 'archived' ? 'selected' : '' }}>В архиве</option>
                            </select>
                            <small class="form-text text-muted">
                                Статус определяет видимость шаблона для пользователей:
                                <ul>
                                    <li><strong>Активный</strong> - шаблон доступен для использования</li>
                                    <li><strong>Черновик</strong> - шаблон в разработке, недоступен для использования</li>
                                    <li><strong>В архиве</strong> - шаблон временно недоступен</li>
                                </ul>
                            </small>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="preview_image">Превью шаблона</label>
                            @if($template->preview_image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($template->preview_image) }}" 
                                         alt="Превью шаблона" 
                                         class="img-thumbnail" 
                                         style="max-width: 320px;">
                                </div>
                            @endif
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('preview_image') is-invalid @enderror" 
                                       id="preview_image" 
                                       name="preview_image" 
                                       accept="image/jpeg,image/jpg,image/webp">
                                <label class="custom-file-label" for="preview_image">Выберите новый файл</label>
                            </div>
                            <small class="form-text text-muted">
                                Требования к изображению:
                                <ul>
                                    <li>Размер: 640x360 пикселей</li>
                                    <li>Формат: JPG, JPEG или WEBP</li>
                                    <li>Максимальный размер файла: 250KB</li>
                                </ul>
                                Если не выбран новый файл, текущее превью останется без изменений.
                            </small>
                            @error('preview_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Сохранить изменения
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
</script>
@endpush
@endsection 