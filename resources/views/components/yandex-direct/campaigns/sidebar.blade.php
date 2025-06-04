@props(['campaign'])

<div class="card">
    <div class="card-body p-0">
        <div class="p-3 border-bottom">
            <h5 class="mb-0">Кампания</h5>
            <small class="text-muted">{{ $campaign->name }}</small>
        </div>
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.settings', [$campaign->template, $campaign]) }}">
                <i class="fas fa-sliders-h me-2"></i>Настройки кампании
            </a>
            <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.additional-settings', [$campaign->template, $campaign]) }}">
                <i class="fas fa-cogs me-2"></i>Дополнительные настройки
            </a>
            <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.limits', [$campaign->template, $campaign]) }}">
                <i class="fas fa-ban me-2"></i>Ограничения
            </a>
            <a class="nav-link" href="{{ route('boss.direct-templates.campaigns.ad-groups.create', [$campaign->template, $campaign]) }}">
                <i class="fas fa-plus me-2"></i>Добавить группу
            </a>
        </div>
    </div>
</div> 