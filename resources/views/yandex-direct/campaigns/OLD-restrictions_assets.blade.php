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
    setupTagInput('negative_keywords_input', 'add_negative_keyword', 'negative_keywords', validateNegativeKeyword);
    setupTagInput('excluded_sites_input', 'add_excluded_site', 'excluded_sites', validateExcludedSite);
    setupTagInput('blocked_ips_input', 'add_blocked_ip', 'blocked_ips', validateBlockedIp);
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