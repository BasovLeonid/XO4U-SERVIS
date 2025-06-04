@extends('boss.layouts.app')

@section('title', 'Редактирование шаблона Яндекс.Директ')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0">Редактирование шаблона кампании</h1>
        </div>
    </div>

    <div class="row">
        <!-- Левая панель навигации -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3 border-bottom">
                        <h5 class="mb-0">Шаблон</h5>
                        <small class="text-muted">{{ $template->name }}</small>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-template-tab" data-bs-toggle="pill" href="#v-pills-template" role="tab" aria-controls="v-pills-template" aria-selected="true">
                            <i class="fas fa-cog me-2"></i>Настройки шаблона
                        </a>

                        <div class="border-top my-2"></div>

                        @foreach($template->campaigns as $campaign)
                            <div class="campaign-block">
                                <div class="d-flex justify-content-between align-items-center p-2 campaign-header" data-campaign-id="{{ $campaign->id }}">
                                    <span class="campaign-name">{{ $campaign->name }}</span>
                                    <button class="btn btn-sm btn-link toggle-campaign" data-campaign-id="{{ $campaign->id }}">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="campaign-menu ms-3" id="campaign-menu-{{ $campaign->id }}">
                                    <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.settings', [$template, $campaign]) }}">
                                        <i class="fas fa-sliders-h me-2"></i>Настройка компании
                                    </a>
                                    <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.additional-settings', [$template, $campaign]) }}">
                                        <i class="fas fa-cogs me-2"></i>Дополнительные настройки
                                    </a>
                                    <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.limits', [$template, $campaign]) }}">
                                        <i class="fas fa-ban me-2"></i>Ограничения
                                    </a>
                                    <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.ad-groups.create', [$template, $campaign]) }}">
                                        <i class="fas fa-plus me-2"></i>Добавить группу
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <div class="border-top my-2"></div>

                        <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.create', $template) }}" id="addCampaignBtn">
                            <i class="fas fa-plus me-2"></i>Новая компания
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Основной контент -->
        <div class="col-md-9">
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
                        @include('boss.direct-templates.partials.campaign-settings', ['direct_template' => $campaign])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

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

    // Обработка сворачивания/разворачивания кампаний
    document.querySelectorAll('.toggle-campaign').forEach(button => {
        button.addEventListener('click', function() {
            const campaignId = this.dataset.campaignId;
            const menu = document.getElementById(`campaign-menu-${campaignId}`);
            const icon = this.querySelector('i');
            
            if (menu.style.display === 'none') {
                menu.style.display = 'block';
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-down');
            } else {
                menu.style.display = 'none';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-right');
            }
        });
    });

    // Инициализация состояния меню кампаний
    document.querySelectorAll('.campaign-menu').forEach(menu => {
        menu.style.display = 'block';
    });
</script>
@endpush

<style>
.campaign-block {
    border-left: 2px solid #dee2e6;
    margin-bottom: 0.5rem;
}

.campaign-header {
    background-color: #f8f9fa;
    cursor: pointer;
}

.campaign-header:hover {
    background-color: #e9ecef;
}

.campaign-name {
    font-weight: 500;
}

.campaign-menu {
    padding: 0.5rem 0;
}
</style> 