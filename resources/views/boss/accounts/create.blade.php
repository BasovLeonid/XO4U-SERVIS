@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Создание рекламного аккаунта</h3>
                    <div class="card-tools">
                        <a href="{{ route('boss.accounts.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Назад к списку
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="createAccountForm" action="{{ route('boss.accounts.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="type">Тип аккаунта <span class="text-danger">*</span></label>
                            <select name="type" 
                                    id="type" 
                                    class="form-control @error('type') is-invalid @enderror" 
                                    required>
                                <option value="">Выберите тип</option>
                                <option value="yandex" {{ old('type') == 'yandex' ? 'selected' : '' }}>Яндекс Директ</option>
                                <option value="vk" {{ old('type') == 'vk' ? 'selected' : '' }}>ВК Реклама</option>
                            </select>
                            <small class="form-text text-muted">
                                Выберите рекламную платформу для аккаунта. 
                                Это определит доступные функции и настройки.
                            </small>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subtype">Подтип аккаунта <span class="text-danger">*</span></label>
                            <select name="subtype" 
                                    id="subtype" 
                                    class="form-control @error('subtype') is-invalid @enderror" 
                                    required>
                                <option value="">Выберите подтип</option>
                                <option value="created" {{ old('subtype') == 'created' ? 'selected' : '' }}>Созданный нами</option>
                                <option value="added" {{ old('subtype') == 'added' ? 'selected' : '' }}>Добавленный пользователем</option>
                            </select>
                            <small class="form-text text-muted">
                                Укажите, как был создан аккаунт:
                                <ul>
                                    <li><strong>Созданный нами</strong> - аккаунт создан через нашу систему</li>
                                    <li><strong>Добавленный пользователем</strong> - существующий аккаунт, добавленный пользователем</li>
                                </ul>
                            </small>
                            @error('subtype')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="login">Логин <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="login" 
                                   id="login" 
                                   class="form-control @error('login') is-invalid @enderror" 
                                   value="{{ old('login') }}" 
                                   required
                                   placeholder="Введите логин аккаунта">
                            <small class="form-text text-muted">
                                Логин для входа в рекламный аккаунт. 
                                Для Яндекс.Директ это может быть email или логин, для ВК - email.
                            </small>
                            @error('login')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Пароль <span class="text-danger">*</span></label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   value="{{ old('password') }}" 
                                   required
                                   minlength="8"
                                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Минимум 8 символов, включая цифры, строчные и заглавные буквы">
                            <small class="form-text text-muted">
                                Пароль для входа в рекламный аккаунт. 
                                Должен содержать минимум 8 символов, включая цифры, строчные и заглавные буквы.
                            </small>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="oauth_token">OAuth токен</label>
                            <textarea name="oauth_token" 
                                      id="oauth_token" 
                                      class="form-control @error('oauth_token') is-invalid @enderror" 
                                      rows="3"
                                      placeholder="Введите OAuth токен, если он есть">{{ old('oauth_token') }}</textarea>
                            <small class="form-text text-muted">
                                OAuth токен для доступа к API рекламной платформы. 
                                Необязательное поле, но рекомендуется для автоматизации работы с аккаунтом.
                            </small>
                            @error('oauth_token')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Статус <span class="text-danger">*</span></label>
                            <select name="status" 
                                    id="status" 
                                    class="form-control @error('status') is-invalid @enderror" 
                                    required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Активный</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Архивный</option>
                                <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>На паузе</option>
                            </select>
                            <small class="form-text text-muted">
                                Текущий статус аккаунта:
                                <ul>
                                    <li><strong>Активный</strong> - аккаунт используется и доступен</li>
                                    <li><strong>Архивный</strong> - аккаунт временно не используется</li>
                                    <li><strong>На паузе</strong> - аккаунт временно приостановлен</li>
                                </ul>
                            </small>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_search">Поиск пользователя <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" 
                                       id="user_search" 
                                       class="form-control" 
                                       placeholder="Введите имя пользователя...">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" onclick="searchUsers()">
                                        <i class="fas fa-search"></i> Поиск
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Введите имя пользователя для поиска. 
                                Выберите пользователя из списка результатов, чтобы привязать аккаунт.
                            </small>
                            <div id="user_search_results" class="list-group mt-2" style="display: none;"></div>
                            <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}" required>
                            @error('user_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Создать
                            </button>
                            <a href="{{ route('boss.accounts.index') }}" class="btn btn-default">
                                <i class="fas fa-times"></i> Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function searchUsers() {
    const searchTerm = document.getElementById('user_search').value;
    if (searchTerm.length < 2) {
        alert('Введите минимум 2 символа для поиска');
        return;
    }

    fetch(`/api/users/search?q=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
            const resultsDiv = document.getElementById('user_search_results');
            resultsDiv.innerHTML = '';
            
            if (data.length === 0) {
                resultsDiv.innerHTML = '<div class="list-group-item">Пользователи не найдены</div>';
            } else {
                data.forEach(user => {
                    const item = document.createElement('a');
                    item.href = '#';
                    item.className = 'list-group-item list-group-item-action';
                    item.textContent = user.name;
                    item.onclick = function(e) {
                        e.preventDefault();
                        document.getElementById('user_id').value = user.id;
                        document.getElementById('user_search').value = user.name;
                        resultsDiv.style.display = 'none';
                    };
                    resultsDiv.appendChild(item);
                });
            }
            resultsDiv.style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Произошла ошибка при поиске пользователей');
        });
}

// Скрываем результаты поиска при клике вне поля поиска
document.addEventListener('click', function(e) {
    const searchResults = document.getElementById('user_search_results');
    const searchInput = document.getElementById('user_search');
    if (!searchResults.contains(e.target) && e.target !== searchInput) {
        searchResults.style.display = 'none';
    }
});

// Валидация формы
document.getElementById('createAccountForm').addEventListener('submit', function(e) {
    if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
    }
    this.classList.add('was-validated');
});

var triggerTabList = [].slice.call(document.querySelectorAll('#v-pills-tab a'))
triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)
    triggerEl.addEventListener('click', function (event) {
        event.preventDefault()
        tabTrigger.show()
    })
})
</script>
@endpush 