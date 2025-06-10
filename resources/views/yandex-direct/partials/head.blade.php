<!-- Мета-теги -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="Интерфейс управления кампаниями Яндекс.Директ">
<meta name="author" content="XO4U-SERVIS">

<!-- Заголовок страницы -->
<title>@yield('title', 'Яндекс.Директ - Управление кампаниями') | XO4U-SERVIS</title>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<!-- Шрифты -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Стили -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">

<!-- Скрипты -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ru.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/ru.js"></script>

<!-- Инициализация компонентов -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация Flatpickr
    flatpickr('.datepicker', {
        locale: 'ru',
        dateFormat: 'd.m.Y',
        allowInput: true
    });

    // Инициализация Select2
    $('.select2').select2({
        theme: 'bootstrap-5',
        language: 'ru',
        width: '100%'
    });

    // Настройка CSRF для AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>

<!-- Дополнительные стили -->
<style>
:root {
    --yandex-primary: #fc3f1d;
    --yandex-secondary: #ffcc00;
    --yandex-text: #333333;
    --yandex-border: #e0e0e0;
    --yandex-background: #ffffff;
    --yandex-hover: #f5f5f5;
}

body {
    font-family: 'Inter', sans-serif;
    color: var(--yandex-text);
    background-color: var(--yandex-background);
}

/* Стили для Select2 */
.select2-container--bootstrap-5 .select2-selection {
    border-color: var(--yandex-border);
}

.select2-container--bootstrap-5 .select2-selection--single {
    height: 38px;
    padding: 0.375rem 0.75rem;
}

/* Стили для Flatpickr */
.flatpickr-calendar {
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.flatpickr-day.selected {
    background: var(--yandex-primary);
    border-color: var(--yandex-primary);
}

/* Стили для кнопок */
.btn-yandex {
    background-color: var(--yandex-primary);
    border-color: var(--yandex-primary);
    color: white;
}

.btn-yandex:hover {
    background-color: #e6391a;
    border-color: #e6391a;
    color: white;
}

/* Стили для форм */
.form-control:focus {
    border-color: var(--yandex-primary);
    box-shadow: 0 0 0 0.2rem rgba(252, 63, 29, 0.25);
}

/* Стили для карточек */
.card {
    border-color: var(--yandex-border);
    border-radius: 8px;
}

.card-header {
    background-color: var(--yandex-background);
    border-bottom-color: var(--yandex-border);
}

/* Стили для таблиц */
.table {
    color: var(--yandex-text);
}

.table thead th {
    border-bottom-color: var(--yandex-border);
    font-weight: 500;
}

.table td {
    border-color: var(--yandex-border);
}

/* Стили для навигации */
.nav-link {
    color: var(--yandex-text);
}

.nav-link:hover {
    color: var(--yandex-primary);
}

.nav-link.active {
    color: var(--yandex-primary);
    font-weight: 500;
}
</style>

@stack('styles') 