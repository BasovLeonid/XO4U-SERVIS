<!-- Ограничения -->
<div class="mb-4">
    <!-- Минус-фразы -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="mb-4">
                <label class="form-label">Минус-фразы</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="negative_keyword_input" 
                           placeholder="Введите минус-фразу и нажмите Enter или запятую">
                    <button class="btn btn-outline-secondary" type="button" id="add_negative_keyword">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div id="negative_keywords_container" class="mb-2">
                    <!-- Здесь будут отображаться теги минус-фраз -->
                </div>
                <div class="form-text">
                    <ul class="mb-0">
                        <li>Указывайте минус-фразу без минуса перед первым словом</li>
                        <li>Не более 7 слов в минус-фразе</li>
                        <li>Длина каждого слова — не более 35 символов</li>
                        <li>Суммарная длина минус-фраз — не более 20000 символов</li>
                    </ul>
                </div>
                <input type="hidden" name="negative_keywords" id="negative_keywords" value="{{ old('negative_keywords', '[]') }}">
            </div>
        </div>
    </div>

    <!-- Запрет показов -->
    <div class="card">
        <div class="card-body">
            <h6 class="mb-3">Запрет показов</h6>

            <!-- Площадки -->
            <div class="mb-4">
                <label class="form-label">Площадки</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="excluded_site_input" 
                           placeholder="Введите домен, bundle ID или package name и нажмите Enter или запятую">
                    <button class="btn btn-outline-secondary" type="button" id="add_excluded_site">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div id="excluded_sites_container" class="mb-2">
                    <!-- Здесь будут отображаться теги площадок -->
                </div>
                <div class="form-text">
                    <ul class="mb-0">
                        <li>Доменные имена сайтов</li>
                        <li>Идентификаторы мобильных приложений (bundle ID для iOS, package name для Android)</li>
                        <li>Наименования внешних сетей (SSP)</li>
                        <li>Не более 1000 элементов</li>
                        <li>Не более 255 символов в каждом элементе</li>
                    </ul>
                </div>
                <input type="hidden" name="excluded_sites" id="excluded_sites" value="{{ old('excluded_sites', '[]') }}">
            </div>

            <!-- IP-адреса -->
            <div class="mb-4">
                <label class="form-label">IP-адреса</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="blocked_ip_input" 
                           placeholder="Введите IP-адрес и нажмите Enter или запятую">
                    <button class="btn btn-outline-secondary" type="button" id="add_blocked_ip">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <div id="blocked_ips_container" class="mb-2">
                    <!-- Здесь будут отображаться теги IP-адресов -->
                </div>
                <div class="form-text">
                    <ul class="mb-0">
                        <li>Не более 25 IP-адресов</li>
                        <li>Формат: xxx.xxx.xxx.xxx</li>
                    </ul>
                </div>
                <input type="hidden" name="blocked_ips" id="blocked_ips" value="{{ old('blocked_ips', '[]') }}">
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.tag-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    padding: 0.5rem;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    min-height: 38px;
}

.tag {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.5rem;
    background-color: #e9ecef;
    border-radius: 0.25rem;
    font-size: 0.875rem;
}

.tag .remove-tag {
    margin-left: 0.5rem;
    cursor: pointer;
    color: #6c757d;
}

.tag .remove-tag:hover {
    color: #dc3545;
}

.tag.error {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация тегов из сохраненных значений
    initializeTags('negative_keywords', JSON.parse(document.getElementById('negative_keywords').value));
    initializeTags('excluded_sites', JSON.parse(document.getElementById('excluded_sites').value));
    initializeTags('blocked_ips', JSON.parse(document.getElementById('blocked_ips').value));

    // Обработчики для добавления тегов
    setupTagInput('negative_keyword_input', 'add_negative_keyword', 'negative_keywords', validateNegativeKeyword);
    setupTagInput('excluded_site_input', 'add_excluded_site', 'excluded_sites', validateExcludedSite);
    setupTagInput('blocked_ip_input', 'add_blocked_ip', 'blocked_ips', validateBlockedIp);
});

function initializeTags(containerId, tags) {
    const container = document.getElementById(containerId + '_container');
    container.innerHTML = '';
    tags.forEach(tag => addTag(containerId, tag));
}

function setupTagInput(inputId, buttonId, containerId, validator) {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    const container = document.getElementById(containerId + '_container');

    function addTagFromInput() {
        const value = input.value.trim();
        if (value) {
            const values = value.split(/[,\n]/).map(v => v.trim()).filter(v => v);
            values.forEach(v => {
                if (validator(v)) {
                    addTag(containerId, v);
                }
            });
            input.value = '';
            updateHiddenInput(containerId);
        }
    }

    input.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addTagFromInput();
        }
    });

    button.addEventListener('click', addTagFromInput);
}

function addTag(containerId, value) {
    const container = document.getElementById(containerId + '_container');
    const tag = document.createElement('span');
    tag.className = 'tag';
    tag.innerHTML = `
        ${value}
        <span class="remove-tag" onclick="removeTag('${containerId}', this)">
            <i class="fas fa-times"></i>
        </span>
    `;
    container.appendChild(tag);
    updateHiddenInput(containerId);
}

function removeTag(containerId, element) {
    element.parentElement.remove();
    updateHiddenInput(containerId);
}

function updateHiddenInput(containerId) {
    const container = document.getElementById(containerId + '_container');
    const tags = Array.from(container.getElementsByClassName('tag'))
        .map(tag => tag.textContent.trim());
    document.getElementById(containerId).value = JSON.stringify(tags);
}

function validateNegativeKeyword(value) {
    const words = value.split(/\s+/);
    if (words.length > 7) {
        showError('negative_keywords', 'Не более 7 слов в минус-фразе');
        return false;
    }
    if (words.some(word => word.length > 35)) {
        showError('negative_keywords', 'Длина каждого слова не должна превышать 35 символов');
        return false;
    }
    return true;
}

function validateExcludedSite(value) {
    if (value.length > 255) {
        showError('excluded_sites', 'Длина не должна превышать 255 символов');
        return false;
    }
    return true;
}

function validateBlockedIp(value) {
    const ipRegex = /^(\d{1,3}\.){3}\d{1,3}$/;
    if (!ipRegex.test(value)) {
        showError('blocked_ips', 'Неверный формат IP-адреса');
        return false;
    }
    return true;
}

function showError(containerId, message) {
    const container = document.getElementById(containerId + '_container');
    const errorTag = document.createElement('span');
    errorTag.className = 'tag error';
    errorTag.textContent = message;
    container.appendChild(errorTag);
    setTimeout(() => errorTag.remove(), 3000);
}
</script>
@endpush 