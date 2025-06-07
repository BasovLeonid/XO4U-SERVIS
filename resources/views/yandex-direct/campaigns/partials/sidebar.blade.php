@props(['campaign'])

<div class="card">
    <div class="card-body p-0">
        <div class="p-3 border-bottom">
            <h5 class="mb-0">Кампания</h5>
            <small class="text-muted">{{ $campaign->name }}</small>
        </div>
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a href="{{ route('boss.direct-templates.campaigns.settings', [$campaign->template, $campaign]) }}" 
               class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.settings') ? 'active' : '' }}">
                <i class="fas fa-cog me-2"></i>Основные настройки
            </a>
            <a href="{{ route('boss.direct-templates.campaigns.schedule', [$campaign->template, $campaign]) }}" 
               class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.schedule') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt me-2"></i>Расписание показов
            </a>
            <a href="{{ route('boss.direct-templates.campaigns.corrections', [$campaign->template, $campaign]) }}" 
               class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.corrections') ? 'active' : '' }}">
                <i class="fas fa-sliders-h me-2"></i>Корректировки
            </a>
            <a href="{{ route('boss.direct-templates.campaigns.restrictions', [$campaign->template, $campaign]) }}" 
               class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.restrictions') ? 'active' : '' }}">
                <i class="fas fa-ban me-2"></i>Ограничения
            </a>
            <a href="{{ route('boss.direct-templates.campaigns.additional-settings', [$campaign->template, $campaign]) }}" 
               class="nav-link {{ request()->routeIs('boss.direct-templates.campaigns.additional-settings') ? 'active' : '' }}">
                <i class="fas fa-cogs me-2"></i>Дополнительные настройки
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
.nav-pills .nav-link {
    border-radius: 0;
    padding: 0.75rem 1rem;
    color: #495057;
}

.nav-pills .nav-link:hover {
    background-color: #f8f9fa;
}

.nav-pills .nav-link.active {
    background-color: #0d6efd;
    color: #fff;
}

.nav-pills .nav-link i {
    width: 1.25rem;
    text-align: center;
}
</style>
@endpush
