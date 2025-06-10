/* Переменные */
:root {
    --yandex-primary: #fc3f1d;
    --yandex-secondary: #ffcc00;
    --yandex-text: #333333;
    --yandex-border: #e0e0e0;
    --yandex-background: #ffffff;
    --yandex-hover: #f5f5f5;
}

/* Основные стили */
body {
    font-family: 'Inter', sans-serif;
    color: var(--yandex-text);
    background-color: var(--yandex-background);
}

/* Основные стили интерфейса */
.yandex-direct-interface {
    min-height: 100vh;
    background: var(--yandex-background);
    display: flex;
    flex-direction: column;
}

.interface-container {
    display: flex;
    flex: 1;
    min-height: 100vh;
    position: relative;
}

/* Стили для кнопки закрытия */
.close-button-container {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 1000;
}

.close-button-container .btn {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--yandex-background);
    border: 1px solid var(--yandex-border);
    color: var(--yandex-text);
    transition: all 0.2s ease;
}

.close-button-container .btn:hover {
    background: var(--yandex-hover);
    border-color: var(--yandex-primary);
    color: var(--yandex-primary);
}

/* Стили сайдбара */
.yandex-direct-interface .sidebar {
    width: 280px;
    flex-shrink: 0;
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: var(--yandex-border) var(--yandex-background);
    background: var(--yandex-background);
    border-right: 1px solid var(--yandex-border);
    z-index: 1000;
}

.yandex-direct-interface .sidebar::-webkit-scrollbar {
    width: 4px;
}

.yandex-direct-interface .sidebar::-webkit-scrollbar-track {
    background: var(--yandex-background);
}

.yandex-direct-interface .sidebar::-webkit-scrollbar-thumb {
    background-color: var(--yandex-border);
    border-radius: 2px;
}

/* Стили основного контента */
.yandex-direct-interface .content {
    flex: 1;
    margin-left: 280px;
    padding: 2rem;
    background: var(--yandex-background);
    min-height: 100vh;
    position: relative;
}

/* Стили секций */
.settings-section {
    background: var(--yandex-background);
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
    padding: 1.5rem;
    transition: all 0.2s ease;
}

.settings-section:hover {
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.section-title {
    font-size: 1.25rem;
    font-weight: 500;
    color: var(--yandex-text);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--yandex-hover);
}

/* Стили форм */
.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    font-weight: 500;
    color: var(--yandex-text);
    margin-bottom: 0.5rem;
}

.form-control {
    border: 1px solid var(--yandex-border);
    border-radius: 6px;
    padding: 0.625rem 0.875rem;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: var(--yandex-primary);
    box-shadow: 0 0 0 3px rgba(252, 63, 29, 0.1);
}

/* Стили Select2 */
.select2-container--bootstrap-5 .select2-selection {
    border-color: var(--yandex-border);
}

.select2-container--bootstrap-5 .select2-selection--single {
    height: 38px;
    padding: 0.375rem 0.75rem;
}

/* Стили Flatpickr */
.flatpickr-calendar {
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.flatpickr-day.selected {
    background: var(--yandex-primary);
    border-color: var(--yandex-primary);
}

/* Стили кнопок */
.form-actions {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--yandex-hover);
    border-radius: 8px;
    margin-top: 2rem;
}

.btn {
    padding: 0.625rem 1.25rem;
    font-weight: 500;
    border-radius: 6px;
    transition: all 0.2s ease;
}

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

.btn-outline-secondary {
    border-color: var(--yandex-border);
    color: var(--yandex-text);
}

.btn-outline-secondary:hover {
    background: var(--yandex-hover);
    border-color: var(--yandex-border);
    color: var(--yandex-text);
}

/* Стили карточек */
.card {
    border-color: var(--yandex-border);
    border-radius: 8px;
}

.card-header {
    background-color: var(--yandex-background);
    border-bottom-color: var(--yandex-border);
}

/* Стили таблиц */
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

/* Стили навигации */
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

/* Адаптивность */
@media (max-width: 1024px) {
    .yandex-direct-interface .content {
        margin-left: 0;
        padding: 1rem;
    }

    .yandex-direct-interface .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .yandex-direct-interface .sidebar.show {
        transform: translateX(0);
    }
}

@media (max-width: 768px) {
    .interface-container {
        flex-direction: column;
    }

    .yandex-direct-interface .sidebar {
        width: 100%;
        position: relative;
        height: auto;
        border-right: none;
        border-bottom: 1px solid var(--yandex-border);
        transform: none;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
    }
} 