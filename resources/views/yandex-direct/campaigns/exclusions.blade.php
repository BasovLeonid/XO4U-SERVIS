@props(['exclusions' => null])

<!-- Запрет показов -->
<div class="card">
    <div class="card-body">
        <h6 class="mb-3">Запрет показов</h6>

        <!-- Площадки -->
        <div class="mb-4">
            <label class="form-label">Площадки</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="excluded_sites_input" 
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
            <input type="hidden" name="excluded_sites[items]" id="excluded_sites" value="{{ old('excluded_sites.items', $exclusions->first()?->excluded_sites['items'] ?? '[]') }}">
        </div>

        <!-- IP-адреса -->
        <div class="mb-4">
            <label class="form-label">IP-адреса</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="blocked_ips_input" 
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
            <input type="hidden" name="blocked_ips[items]" id="blocked_ips" value="{{ old('blocked_ips.items', $exclusions->first()?->blocked_ips['items'] ?? '[]') }}">
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Функции для работы с площадками
    const excludedSitesInput = document.getElementById('excluded_sites_input');
    const addExcludedSiteBtn = document.getElementById('add_excluded_site');
    const excludedSitesContainer = document.getElementById('excluded_sites_container');
    const excludedSitesHidden = document.getElementById('excluded_sites');
    
    // Функции для работы с IP-адресами
    const blockedIpsInput = document.getElementById('blocked_ips_input');
    const addBlockedIpBtn = document.getElementById('add_blocked_ip');
    const blockedIpsContainer = document.getElementById('blocked_ips_container');
    const blockedIpsHidden = document.getElementById('blocked_ips');
    
    // Загрузка существующих данных
    let excludedSites = JSON.parse(excludedSitesHidden.value || '[]');
    let blockedIps = JSON.parse(blockedIpsHidden.value || '[]');
    
    function updateExcludedSites() {
        excludedSitesHidden.value = JSON.stringify(excludedSites);
        renderExcludedSites();
    }
    
    function updateBlockedIps() {
        blockedIpsHidden.value = JSON.stringify(blockedIps);
        renderBlockedIps();
    }
    
    function renderExcludedSites() {
        excludedSitesContainer.innerHTML = '';
        excludedSites.forEach((site, index) => {
            const tag = document.createElement('span');
            tag.className = 'badge bg-secondary me-2 mb-2';
            tag.innerHTML = `
                ${site}
                <button type="button" class="btn-close btn-close-white ms-2" 
                        style="font-size: 0.5rem;" 
                        data-index="${index}"></button>
            `;
            excludedSitesContainer.appendChild(tag);
        });
        
        // Добавляем обработчики для кнопок удаления
        document.querySelectorAll('#excluded_sites_container .btn-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                excludedSites.splice(index, 1);
                updateExcludedSites();
            });
        });
    }
    
    function renderBlockedIps() {
        blockedIpsContainer.innerHTML = '';
        blockedIps.forEach((ip, index) => {
            const tag = document.createElement('span');
            tag.className = 'badge bg-secondary me-2 mb-2';
            tag.innerHTML = `
                ${ip}
                <button type="button" class="btn-close btn-close-white ms-2" 
                        style="font-size: 0.5rem;" 
                        data-index="${index}"></button>
            `;
            blockedIpsContainer.appendChild(tag);
        });
        
        // Добавляем обработчики для кнопок удаления
        document.querySelectorAll('#blocked_ips_container .btn-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                blockedIps.splice(index, 1);
                updateBlockedIps();
            });
        });
    }
    
    function addExcludedSite(site) {
        site = site.trim();
        if (!site) return;
        
        // Проверка на максимальное количество элементов
        if (excludedSites.length >= 1000) {
            alert('Достигнуто максимальное количество площадок (1000)');
            return;
        }
        
        // Проверка на длину
        if (site.length > 255) {
            alert('Длина элемента не должна превышать 255 символов');
            return;
        }
        
        // Проверка на дубликаты
        if (excludedSites.includes(site)) {
            alert('Такая площадка уже добавлена');
            return;
        }
        
        excludedSites.push(site);
        updateExcludedSites();
        excludedSitesInput.value = '';
    }
    
    function addBlockedIp(ip) {
        ip = ip.trim();
        if (!ip) return;
        
        // Проверка формата IP-адреса
        const ipRegex = /^(\d{1,3}\.){3}\d{1,3}$/;
        if (!ipRegex.test(ip)) {
            alert('Неверный формат IP-адреса. Используйте формат: xxx.xxx.xxx.xxx');
            return;
        }
        
        // Проверка на максимальное количество элементов
        if (blockedIps.length >= 25) {
            alert('Достигнуто максимальное количество IP-адресов (25)');
            return;
        }
        
        // Проверка на дубликаты
        if (blockedIps.includes(ip)) {
            alert('Такой IP-адрес уже добавлен');
            return;
        }
        
        blockedIps.push(ip);
        updateBlockedIps();
        blockedIpsInput.value = '';
    }
    
    // Обработчики для площадок
    addExcludedSiteBtn.addEventListener('click', () => {
        addExcludedSite(excludedSitesInput.value);
    });
    
    excludedSitesInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addExcludedSite(excludedSitesInput.value);
        }
    });
    
    // Обработчики для IP-адресов
    addBlockedIpBtn.addEventListener('click', () => {
        addBlockedIp(blockedIpsInput.value);
    });
    
    blockedIpsInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addBlockedIp(blockedIpsInput.value);
        }
    });
    
    // Инициализация отображения существующих данных
    renderExcludedSites();
    renderBlockedIps();
});
</script>
@endpush 