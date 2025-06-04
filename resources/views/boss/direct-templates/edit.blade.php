@extends('boss.layouts.app')

@section('title', 'Редактирование шаблона Яндекс.Директ')

@section('content')
<x-boss.direct-templates.container title="Редактирование шаблона кампании">
    <x-slot:sidebar>
        <x-boss.direct-templates.sidebar :template="$template" />
    </x-slot>

    <div class="tab-content" id="v-pills-tabContent">
        <!-- Вкладка настроек шаблона -->
        <div class="tab-pane fade show active" id="v-pills-template" role="tabpanel" aria-labelledby="v-pills-template-tab">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('boss.direct-templates.update', $template) }}" method="POST" enctype="multipart/form-data" id="templateForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Название шаблона</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $template->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Описание</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $template->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Типы шаблона</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="types[]" value="search" 
                                       id="type_search" {{ in_array('search', old('types', $template->types ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_search">
                                    Поиск
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="types[]" value="network" 
                                       id="type_network" {{ in_array('network', old('types', $template->types ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_network">
                                    РСЯ
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="types[]" value="maps" 
                                       id="type_maps" {{ in_array('maps', old('types', $template->types ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="type_maps">
                                    Реклама на картах
                                </label>
                            </div>
                            @error('types')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="strategy">Стратегия показа</label>
                            <input type="text" class="form-control @error('strategy') is-invalid @enderror" 
                                   id="strategy" name="strategy" value="{{ old('strategy', $template->strategy) }}" required>
                            @error('strategy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Изображение шаблона</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/jpeg,image/jpg,image/webp">
                                <label class="custom-file-label" for="image">Выберите файл</label>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($template->image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($template->image) }}" alt="Изображение шаблона" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Вкладки кампаний -->
        @foreach($template->campaigns as $campaign)
            <div class="tab-pane fade" id="v-pills-campaign-{{ $campaign->id }}" role="tabpanel" aria-labelledby="v-pills-campaign-{{ $campaign->id }}-tab">
                <x-yandex-direct.campaigns.basic-settings :campaign="$campaign" />
                <x-yandex-direct.campaigns.advanced-settings :campaign="$campaign" :counters="$counters" :goals="$goals" />
            </div>
        @endforeach
    </div>
</x-boss.direct-templates.container>

<!-- Модальное окно подтверждения -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Есть несохраненные изменения</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                У вас есть несохраненные изменения. Хотите сохранить их перед продолжением?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" id="saveAndContinue">Сохранить и продолжить</button>
                <button type="button" class="btn btn-warning" id="continueWithoutSave">Продолжить без сохранения</button>
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

    // Отслеживание изменений в форме
    let formChanged = false;
    const form = document.getElementById('templateForm');
    const originalFormData = new FormData(form);

    form.addEventListener('change', function() {
        formChanged = true;
    });

    // Обработка кнопки "Добавить кампанию"
    document.getElementById('addCampaignBtn').addEventListener('click', function(e) {
        if (formChanged) {
            e.preventDefault();
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        }
    });

    // Обработчики кнопок в модальном окне
    document.getElementById('saveAndContinue').addEventListener('click', function() {
        form.submit();
    });

    document.getElementById('continueWithoutSave').addEventListener('click', function() {
        window.location.href = "{{ route('boss.direct-templates.campaigns.create', $template) }}";
    });

    // Обработка переключения вкладок
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (formChanged && !this.id.includes('addCampaignBtn')) {
                e.preventDefault();
                const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            }
        });
    });
</script>
@endpush 