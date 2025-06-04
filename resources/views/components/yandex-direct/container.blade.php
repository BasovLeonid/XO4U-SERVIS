@props(['title'])

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0">{{ $title }}</h1>
        </div>
    </div>

    <div class="row">
        <!-- Левая панель навигации -->
        <div class="col-md-3">
            {{ $sidebar }}
        </div>

        <!-- Основной контент -->
        <div class="col-md-9">
            {{ $slot }}
        </div>
    </div>
</div> 