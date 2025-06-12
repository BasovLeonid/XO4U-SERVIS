@props(['campaign' => null])

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Основные настройки кампании</h5>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="name">Название кампании</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('name', $campaign->first()?->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="status">Статус кампании</label>
            <select class="form-select @error('status') is-invalid @enderror" 
                    id="status" name="status" required>
                <option value="active" {{ old('status', $campaign->first()?->status) == 'active' ? 'selected' : '' }}>Активна</option>
                <option value="paused" {{ old('status', $campaign->first()?->status) == 'paused' ? 'selected' : '' }}>На паузе</option>
                <option value="stopped" {{ old('status', $campaign->first()?->status) == 'stopped' ? 'selected' : '' }}>Остановлена</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="url">Рекламируемая страница</label>
            <input type="url" class="form-control @error('url') is-invalid @enderror" 
                   id="url" name="url" value="{{ old('url', $campaign->first()?->url) }}" required>
            @error('url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Места показа</h5>
    </div>
    <div class="card-body">
        <h6 class="mb-3">Поиск</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_result" 
                   id="search_result" value="YES" 
                   {{ old('search_result', $campaign->first()?->search_result) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="search_result">
                Реклама в поисковой выдаче
                <small class="d-block text-muted">Разместите свои объявления в специальных рекламных блоках на страницах результатов поиска</small>
            </label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="dynamic_places" 
                   id="dynamic_places" value="YES" 
                   {{ old('dynamic_places', $campaign->first()?->dynamic_places) == 'YES' ? 'checked' : '' }}
                   data-requires="search_result">
            <label class="form-check-label" for="dynamic_places">
                Динамические места на поиске
                <small class="d-block text-muted">Получайте дополнительные конверсии, повышая видимость своих страниц в поиске по товарам и услугам</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="product_gallery" 
                   id="product_gallery" value="YES" 
                   {{ old('product_gallery', $campaign->first()?->product_gallery) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="product_gallery">
                Товарная галерея на поиске
                <small class="d-block text-muted">Покажите свои предложения в карусели товаров из разных магазинов, которая появляется над результатами поиска</small>
            </label>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input platform-checkbox" type="checkbox" name="search_organization_list" 
                   id="search_organization_list" value="YES" 
                   {{ old('search_organization_list', $campaign->first()?->search_organization_list) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="search_organization_list">
                Список организаций в результатах поиска
                <small class="d-block text-muted">Станьте заметнее среди других организаций из Яндекс Бизнеса, которые появляются над результатами поиска</small>
            </label>
        </div>

        <h6 class="mb-3">Сети</h6>
        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="network" 
                   id="network" value="YES" 
                   {{ old('network', $campaign->first()?->network) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="network">
                Рекламная сеть Яндекса
                <small class="d-block text-muted">Охватите посетителей десятков тысяч сайтов и приложений, которым могут быть интересны ваши товары и услуги</small>
            </label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input platform-checkbox" type="checkbox" name="maps" 
                   id="maps" value="YES" 
                   {{ old('maps', $campaign->first()?->maps) == 'YES' ? 'checked' : '' }}>
            <label class="form-check-label" for="maps">
                Яндекс Карты
                <small class="d-block text-muted">Поднимитесь в поиске Карт и выделитесь среди других организаций благодаря зелёной метке</small>
            </label>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Функция для проверки выбранных платформ
    function checkPlatforms() {
        const searchPlatforms = ['search_result', 'dynamic_places', 'product_gallery', 'search_organization_list'];
        const networkPlatforms = ['network', 'maps'];
        
        const hasSearch = searchPlatforms.some(platform => 
            document.getElementById(platform).checked
        );
        const hasNetwork = networkPlatforms.some(platform => 
            document.getElementById(platform).checked
        );

        // Показываем/скрываем блоки стратегий
        document.getElementById('search_strategy_block').style.display = hasSearch ? 'block' : 'none';
        document.getElementById('network_strategy_block').style.display = hasNetwork ? 'block' : 'none';
    }

    // Обработчики изменения платформ
    document.querySelectorAll('.platform-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const requiredId = this.dataset.requires;
            if (requiredId) {
                const requiredCheckbox = document.getElementById(requiredId);
                if (this.checked && !requiredCheckbox.checked) {
                    requiredCheckbox.checked = true;
                }
            }
            checkPlatforms();
        });
    });

    // Инициализация при загрузке страницы
    checkPlatforms();
});
</script>
@endpush 