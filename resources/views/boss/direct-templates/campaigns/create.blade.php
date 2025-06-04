@extends('boss.layouts.app')

@section('title', 'Создание кампании')

@section('content')
<x-boss.direct-templates.container title="Создание кампании">
    <x-slot:sidebar>
        <x-yandex-direct.campaigns.sidebar :campaign="null" />
    </x-slot>

    <form action="{{ route('boss.direct-templates.campaigns.store', $template) }}" method="POST">
        @csrf

        <x-yandex-direct.campaigns.basic-settings />
        
        <x-yandex-direct.campaigns.advanced-settings 
            :counters="$counters"
            :goals="$goals" />

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать кампанию</button>
            <a href="{{ route('boss.direct-templates.edit', $template) }}" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</x-boss.direct-templates.container>
@endsection 