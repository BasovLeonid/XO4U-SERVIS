/* Основные стили интерфейса */
.yandex-direct-interface {
    height: 100%;
    background: #fff;
}

.interface-container {
    display: flex;
    height: 100%;
}

/* Стили сайдбара */
.yandex-direct-interface .sidebar {
    width: 280px;
    flex-shrink: 0;
    position: sticky;
    top: 0;
    height: 100%;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #e0e0e0 #fff;
    background: #fff;
    padding: 1.5rem;
    border-right: 1px solid #e2e8f0;
}

.yandex-direct-interface .sidebar::-webkit-scrollbar {
    width: 4px;
}

.yandex-direct-interface .sidebar::-webkit-scrollbar-track {
    background: #fff;
}

.yandex-direct-interface .sidebar::-webkit-scrollbar-thumb {
    background-color: #e0e0e0;
    border-radius: 2px;
}

/* Стили основного контента */
.yandex-direct-interface .content {
    flex-grow: 1;
    max-width: 900px;
    padding: 1.5rem;
    background: #fff;
    overflow-y: auto;
}

/* Стили секций */
.settings-section {
    background: #fff;
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
    color: #2c3e50;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #f0f2f5;
}

/* Стили форм */
.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    font-weight: 500;
    color: #4a5568;
    margin-bottom: 0.5rem;
}

.form-control {
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 0.625rem 0.875rem;
    transition: all 0.2s ease;
}

.form-control:focus {
    border-color: #4299e1;
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
}

/* Стили кнопок */
.form-actions {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 8px;
    margin-top: 2rem;
}

.btn {
    padding: 0.625rem 1.25rem;
    font-weight: 500;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.btn-primary {
    background: #4299e1;
    border-color: #4299e1;
}

.btn-primary:hover {
    background: #3182ce;
    border-color: #3182ce;
}

.btn-outline-secondary {
    border-color: #e2e8f0;
    color: #4a5568;
}

.btn-outline-secondary:hover {
    background: #f7fafc;
    border-color: #cbd5e0;
    color: #2d3748;
}

/* Адаптивность */
@media (max-width: 1024px) {
    .yandex-direct-interface .content {
        max-width: 100%;
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
        border-bottom: 1px solid #e2e8f0;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
    }
} 