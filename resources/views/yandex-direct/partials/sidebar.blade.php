@props(['campaign'])

<div class="card sidebar-sticky">
    <div class="card-body p-0">
        <div class="p-3 border-bottom">
            <h5 class="mb-0">Кампания</h5>
            <small class="text-muted">{{ $campaign->name }}</small>
        </div>
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a href="#basic" class="nav-link">
                <i class="fas fa-cog me-2"></i>Основные настройки
            </a>
            <a href="#schedule" class="nav-link">
                <i class="fas fa-calendar-alt me-2"></i>Расписание показов
            </a>
            <a href="#corrections" class="nav-link">
                <i class="fas fa-sliders-h me-2"></i>Корректировки ставок
            </a>
            <a href="#restrictions" class="nav-link">
                <i class="fas fa-ban me-2"></i>Минус-фразы
            </a>
            <a href="#additional" class="nav-link">
                <i class="fas fa-cogs me-2"></i>Параметры URL
            </a>
            <a href="{{ route('boss.direct-templates.campaigns.ad-groups.create', [$campaign->template, $campaign]) }}" 
               class="nav-link">
                <i class="fas fa-plus me-2"></i>Добавить группу
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
.sidebar-sticky {
    position: sticky;
    top: 1rem;
    height: calc(100vh - 2rem);
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #dee2e6 #fff;
}

.sidebar-sticky::-webkit-scrollbar {
    width: 6px;
}

.sidebar-sticky::-webkit-scrollbar-track {
    background: #fff;
}

.sidebar-sticky::-webkit-scrollbar-thumb {
    background-color: #dee2e6;
    border-radius: 3px;
}

.nav-pills .nav-link {
    border-radius: 0;
    padding: 0.75rem 1rem;
    color: #495057;
    text-decoration: none;
    transition: all 0.2s ease;
}

.nav-pills .nav-link:hover {
    background-color: #f8f9fa;
    color: #0d6efd;
}

.nav-pills .nav-link.active {
    background-color: #0d6efd;
    color: #fff;
}

.nav-pills .nav-link i {
    width: 1.25rem;
    text-align: center;
}

/* Стили для активного якоря */
.nav-pills .nav-link[href*="#"]:target {
    background-color: #0d6efd;
    color: #fff;
}

@media (max-width: 768px) {
    .sidebar-sticky {
        position: relative;
        height: auto;
        top: 0;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Получаем все ссылки с якорями
    const navLinks = document.querySelectorAll('.nav-pills .nav-link[href^="#"]');
    
    // Функция для обновления активного состояния
    function updateActiveLink() {
        const scrollPosition = window.scrollY;
        
        navLinks.forEach(link => {
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                const targetPosition = targetElement.offsetTop;
                const targetHeight = targetElement.offsetHeight;
                
                // Проверяем, находится ли элемент в видимой области
                if (scrollPosition >= targetPosition - 100 && 
                    scrollPosition < targetPosition + targetHeight - 100) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            }
        });
    }
    
    // Обработчик прокрутки
    window.addEventListener('scroll', updateActiveLink);
    
    // Обработчик клика по ссылкам
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Плавная прокрутка к элементу
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Обновляем URL без перезагрузки страницы
                history.pushState(null, null, this.getAttribute('href'));
            }
        });
    });
    
    // Инициализация при загрузке страницы
    updateActiveLink();
});
</script>
@endpush
