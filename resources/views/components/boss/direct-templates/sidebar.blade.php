@props(['template'])

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
        </div>
    </div>
</div>

@push('styles')
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
@endpush

@push('scripts')
<script>
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