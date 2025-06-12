@props(['negativeKeywords' => null])

<!-- Минус-фразы -->
<div class="card mb-4">
    <div class="card-body">
        <div class="mb-4">
            <label class="form-label">Минус-фразы</label>
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="negative_keywords_input" 
                       placeholder="Введите минус-фразу и нажмите Enter или запятую">
                <button class="btn btn-outline-secondary" type="button" id="add_negative_keyword">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div id="negative_keywords_container" class="mb-2">
                <!-- Здесь будут отображаться теги минус-фраз -->
            </div>
            <div class="form-text">
                <ul class="mb-0">
                    <li>Указывайте минус-фразу без минуса перед первым словом</li>
                    <li>Не более 7 слов в минус-фразе</li>
                    <li>Длина каждого слова — не более 35 символов</li>
                    <li>Суммарная длина минус-фраз — не более 20000 символов</li>
                </ul>
            </div>
            <input type="hidden" name="negative_keywords[items]" id="negative_keywords" value="{{ old('negative_keywords.items', $negativeKeywords->first()?->negative_keywords['items'] ?? '[]') }}">
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const negativeKeywordsInput = document.getElementById('negative_keywords_input');
    const addNegativeKeywordBtn = document.getElementById('add_negative_keyword');
    const negativeKeywordsContainer = document.getElementById('negative_keywords_container');
    const negativeKeywordsHidden = document.getElementById('negative_keywords');
    
    // Загрузка существующих минус-фраз
    let negativeKeywords = JSON.parse(negativeKeywordsHidden.value || '[]');
    
    function updateNegativeKeywords() {
        negativeKeywordsHidden.value = JSON.stringify(negativeKeywords);
        renderNegativeKeywords();
    }
    
    function renderNegativeKeywords() {
        negativeKeywordsContainer.innerHTML = '';
        negativeKeywords.forEach((keyword, index) => {
            const tag = document.createElement('span');
            tag.className = 'badge bg-secondary me-2 mb-2';
            tag.innerHTML = `
                ${keyword}
                <button type="button" class="btn-close btn-close-white ms-2" 
                        style="font-size: 0.5rem;" 
                        data-index="${index}"></button>
            `;
            negativeKeywordsContainer.appendChild(tag);
        });
        
        // Добавляем обработчики для кнопок удаления
        document.querySelectorAll('#negative_keywords_container .btn-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                negativeKeywords.splice(index, 1);
                updateNegativeKeywords();
            });
        });
    }
    
    function addNegativeKeyword(keyword) {
        keyword = keyword.trim();
        if (!keyword) return;
        
        // Проверка на максимальное количество слов
        if (keyword.split(/\s+/).length > 7) {
            alert('Минус-фраза не должна содержать более 7 слов');
            return;
        }
        
        // Проверка на длину слов
        const words = keyword.split(/\s+/);
        for (const word of words) {
            if (word.length > 35) {
                alert('Длина каждого слова не должна превышать 35 символов');
                return;
            }
        }
        
        // Проверка на дубликаты
        if (negativeKeywords.includes(keyword)) {
            alert('Такая минус-фраза уже добавлена');
            return;
        }
        
        negativeKeywords.push(keyword);
        updateNegativeKeywords();
        negativeKeywordsInput.value = '';
    }
    
    // Обработка добавления по кнопке
    addNegativeKeywordBtn.addEventListener('click', () => {
        addNegativeKeyword(negativeKeywordsInput.value);
    });
    
    // Обработка добавления по Enter или запятой
    negativeKeywordsInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addNegativeKeyword(negativeKeywordsInput.value);
        }
    });
    
    // Инициализация отображения существующих минус-фраз
    renderNegativeKeywords();
});
</script>
@endpush 