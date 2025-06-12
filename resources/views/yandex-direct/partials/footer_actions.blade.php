<!-- Панель действий внизу страницы -->
<div class="footer-actions">
    <div class="footer-actions-container">
        <div class="footer-actions-content">
            <div class="footer-actions-left">
                <button type="submit" class="btn btn-primary" id="saveButton1">
                    <i class="fas fa-save"></i> Сохранить
                </button>
            </div>
            <div class="footer-actions-right">
                <!-- Здесь можно добавить дополнительные кнопки справа -->
            </div>
        </div>
    </div>
</div>

<style>
.footer-actions {
    position: sticky;
    bottom: 0;
    background: #fff;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    margin-top: 20px;
    border-top: 1px solid #e0e0e0;
}

.footer-actions-container {
    padding: 15px;
}

.footer-actions-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer-actions-left {
    display: flex;
    gap: 10px;
}

.footer-actions-right {
    display: flex;
    gap: 10px;
}

/* Добавляем отступ для контента, чтобы он не перекрывался с панелью */
.content {
    padding-bottom: 20px;
}
</style> 