@extends('boss.layouts.app')

@section('title', 'Настройки кампании')

@section('content')
<div class="settings-page">
    @include('yandex-direct.interface_setting', [
        'campaign' => $campaign,
        'counters' => $counters,
        'goals' => $goals,
        'template' => $template
    ])

    @if(config('app.debug'))
    <div class="debug-container">
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Отладочная информация</h5>
            </div>
            <div class="card-body">
                <h6>Текущие данные кампании:</h6>
                <pre class="bg-light p-3">{{ json_encode($campaign->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .settings-page {
        margin: -1.5rem;
    }
    
    .debug-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1.5rem;
    }
    
    pre {
        max-height: 300px;
        overflow-y: auto;
    }
</style>
@endpush 