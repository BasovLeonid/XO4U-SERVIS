@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Редактирование пользователя</h3>
                    <div class="card-tools">
                        <a href="{{ route('boss.users.index') }}" class="btn btn-default">
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

                    <form action="{{ route('boss.users.update', $user) }}" method="POST" id="editUserForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Имя <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required
                                   placeholder="Введите полное имя пользователя">
                            <small class="form-text text-muted">
                                Введите полное имя пользователя. Это поле будет отображаться в системе и при обращении к пользователю.
                            </small>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                   placeholder="user@example.com">
                            <small class="form-text text-muted">
                                Email используется для входа в систему и восстановления пароля. 
                                Должен быть уникальным и соответствовать формату email@domain.com
                            </small>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $user->phone) }}"
                                   pattern="\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}"
                                   placeholder="+7 (999) 999-99-99">
                            <small class="form-text text-muted">
                                Номер телефона в формате +7 (999) 999-99-99. 
                                Используется для связи с пользователем и может быть использован для восстановления доступа.
                            </small>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="telegram_username">Telegram</label>
                            <input type="text" 
                                   class="form-control @error('telegram_username') is-invalid @enderror" 
                                   id="telegram_username" 
                                   name="telegram_username" 
                                   value="{{ old('telegram_username', $user->telegram_username) }}"
                                   pattern="^@[a-zA-Z0-9_]{5,32}$"
                                   placeholder="@username">
                            <small class="form-text text-muted">
                                Имя пользователя в Telegram в формате @username. 
                                Должно начинаться с @ и содержать от 5 до 32 символов (буквы, цифры и подчеркивания).
                            </small>
                            @error('telegram_username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Новый пароль</label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password"
                                       minlength="8"
                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                       title="Минимум 8 символов, включая цифры, строчные и заглавные буквы">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="generatePassword">
                                        <i class="fas fa-key"></i> Сгенерировать
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Оставьте поле пустым, чтобы не менять пароль. 
                                Если вводите новый пароль, он должен содержать минимум 8 символов, 
                                включая цифры, строчные и заглавные буквы.
                            </small>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Подтверждение нового пароля</label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation">
                            <small class="form-text text-muted">
                                Повторите новый пароль для подтверждения. Оба пароля должны совпадать.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="role">Роль <span class="text-danger">*</span></label>
                            <select class="form-control @error('role') is-invalid @enderror" 
                                    id="role" 
                                    name="role" 
                                    required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Пользователь</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Администратор</option>
                                <option value="partner" {{ old('role', $user->role) == 'partner' ? 'selected' : '' }}>Партнер</option>
                            </select>
                            <small class="form-text text-muted">
                                Выберите роль пользователя в системе:
                                <ul>
                                    <li><strong>Пользователь</strong> - стандартный доступ к личному кабинету</li>
                                    <li><strong>Администратор</strong> - полный доступ к управлению системой</li>
                                    <li><strong>Партнер</strong> - доступ к партнерскому функционалу</li>
                                </ul>
                            </small>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="balance">Баланс</label>
                            <input type="number" 
                                   step="0.01" 
                                   min="0" 
                                   class="form-control @error('balance') is-invalid @enderror" 
                                   id="balance" 
                                   name="balance" 
                                   value="{{ old('balance', $user->balance) }}">
                            <small class="form-text text-muted">
                                Текущий баланс пользователя. Не может быть отрицательным.
                            </small>
                            @error('balance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_spent">Общая сумма</label>
                            <input type="number" 
                                   step="0.01" 
                                   min="0" 
                                   class="form-control @error('total_spent') is-invalid @enderror" 
                                   id="total_spent" 
                                   name="total_spent" 
                                   value="{{ old('total_spent', $user->total_spent) }}">
                            <small class="form-text text-muted">
                                Общая сумма всех покупок пользователя. Не может быть отрицательной.
                            </small>
                            @error('total_spent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="repeat_purchases">LTV</label>
                            <input type="number" 
                                   min="0" 
                                   class="form-control @error('repeat_purchases') is-invalid @enderror" 
                                   id="repeat_purchases" 
                                   name="repeat_purchases" 
                                   value="{{ old('repeat_purchases', $user->repeat_purchases) }}">
                            <small class="form-text text-muted">
                                Lifetime Value - показатель пожизненной ценности клиента. 
                                Количество повторных покупок.
                            </small>
                            @error('repeat_purchases')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_rating">Рейтинг платежеспособности (%)</label>
                            <input type="number" 
                                   step="1" 
                                   min="0" 
                                   max="100" 
                                   class="form-control @error('payment_rating') is-invalid @enderror" 
                                   id="payment_rating" 
                                   name="payment_rating" 
                                   value="{{ old('payment_rating', $user->payment_rating) }}">
                            <small class="form-text text-muted">
                                Оценка платежеспособности пользователя от 0 до 100%. 
                                Используется для определения лимитов и условий работы.
                            </small>
                            @error('payment_rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Сохранить изменения
                            </button>
                            <a href="{{ route('boss.users.index') }}" class="btn btn-default">
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editUserForm');
    const generatePasswordBtn = document.getElementById('generatePassword');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const phoneInput = document.getElementById('phone');

    // Маска для телефона
    phoneInput.addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : '+7 (' + x[2] + (x[3] ? ') ' + x[3] : '') + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
    });

    // Генерация пароля
    generatePasswordBtn.addEventListener('click', function() {
        const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        let password = '';
        for (let i = 0; i < 12; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        passwordInput.value = password;
        confirmPasswordInput.value = password;

        passwordInput.type = 'text';
        confirmPasswordInput.type = 'text';

        setTimeout(() => {
            passwordInput.type = 'password';
            confirmPasswordInput.type = 'password';
        }, 2000);
    });

    // Валидация формы
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });
});
</script>
@endpush 