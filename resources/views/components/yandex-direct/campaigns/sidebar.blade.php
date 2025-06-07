@props(['campaign'])

<div class="list-group">
    <div class="list-group-item">
        <h6 class="mb-0">{{ $campaign->name }}</h6>
    </div>
    
    <a href="{{ route('boss.direct-templates.campaigns.settings', [$campaign->template, $campaign]) }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('boss.direct-templates.campaigns.settings') ? 'active' : '' }}">
        <i class="fas fa-sliders-h me-2"></i>Основные настройки
    </a>

    <a href="{{ route('boss.direct-templates.campaigns.schedule', [$campaign->template, $campaign]) }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('boss.direct-templates.campaigns.schedule') ? 'active' : '' }}">
        <i class="fas fa-calendar-alt me-2"></i>Расписание показов
    </a>

    <a href="{{ route('boss.direct-templates.campaigns.corrections', [$campaign->template, $campaign]) }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('boss.direct-templates.campaigns.corrections') ? 'active' : '' }}">
        <i class="fas fa-percentage me-2"></i>Корректировки
    </a>

    <a href="{{ route('boss.direct-templates.campaigns.additional-settings', [$campaign->template, $campaign]) }}" 
       class="list-group-item list-group-item-action {{ request()->routeIs('boss.direct-templates.campaigns.additional-settings') ? 'active' : '' }}">
        <i class="fas fa-cog me-2"></i>Дополнительные настройки
    </a>

    <a href="{{ route('boss.direct-templates.campaigns.restrictions', [$campaign->template, $campaign]) }}"
       class="list-group-item list-group-item-action {{ request()->routeIs('boss.direct-templates.campaigns.restrictions') ? 'active' : '' }}">
        <i class="fas fa-ban me-2"></i>Ограничения
    </a>

    <a href="{{ route('boss.direct-templates.campaigns.ad-groups.create', [$campaign->template, $campaign]) }}" 
       class="list-group-item list-group-item-action">
        <i class="fas fa-plus me-2"></i>Добавить группу
    </a>
</div> 