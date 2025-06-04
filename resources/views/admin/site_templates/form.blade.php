@php
    $template = $siteTemplate ?? null;
@endphp

<div class="space-y-4">
    <div>
        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Название</label>
        <input type="text" name="name" value="{{ old('name', $template->name ?? '') }}" required class="input w-full" />
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Slug (необязательно)</label>
        <input type="text" name="slug" value="{{ old('slug', $template->slug ?? '') }}" class="input w-full" />
        @error('slug') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Описание</label>
        <textarea name="description" class="input w-full">{{ old('description', $template->description ?? '') }}</textarea>
        @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Путь к шаблону</label>
        <input type="text" name="template_path" value="{{ old('template_path', $template->template_path ?? '') }}" required class="input w-full" />
        @error('template_path') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">URL превью (необязательно)</label>
        <input type="text" name="preview_url" value="{{ old('preview_url', $template->preview_url ?? '') }}" class="input w-full" />
        @error('preview_url') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Variables (JSON)</label>
        <textarea name="variables" required class="input w-full" rows="5">{{ old('variables', isset($template) ? json_encode($template->variables, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '{}') }}</textarea>
        @error('variables') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
</div>
