@php
    $isEdit = isset($template);
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="name">Название шаблона</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $template->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="template_code">Код шаблона</label>
            <input type="text" class="form-control @error('template_code') is-invalid @enderror" id="template_code" name="template_code" value="{{ old('template_code', $template->template_code ?? '') }}" required>
            @error('template_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $template->description ?? '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @if($isEdit)
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="active" {{ old('status', $template->status) === 'active' ? 'selected' : '' }}>Активный</option>
                    <option value="draft" {{ old('status', $template->status) === 'draft' ? 'selected' : '' }}>Черновик</option>
                    <option value="archived" {{ old('status', $template->status) === 'archived' ? 'selected' : '' }}>Архивный</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="preview_image">Превью шаблона</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('preview_image') is-invalid @enderror" id="preview_image" name="preview_image" accept="image/jpeg,image/jpg,image/webp">
                <label class="custom-file-label" for="preview_image">Выберите файл</label>
                <small class="form-text text-muted">
                    Размер: 640x360px, формат: JPG/JPEG/WEBP, макс. размер: 250KB
                </small>
                @error('preview_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if($isEdit && $template->preview_image)
                <div class="mt-2">
                    <div class="preview-container">
                        <img src="{{ Storage::url($template->preview_image) }}" 
                             class="img-fluid rounded" 
                             alt="Превью">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> {{ $isEdit ? 'Сохранить изменения' : 'Создать шаблон' }}
        </button>
        <a href="{{ route('boss.site-templates.index') }}" class="btn btn-default">
            <i class="fas fa-times"></i> Отмена
        </a>
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
</style>
@endpush

@push('scripts')
<script>
    // Обновление имени файла в label при выборе
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush 