@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- График статистики -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Статистика регистраций</h3>
                </div>
                <div class="card-body">
                    <canvas id="registrationChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Таблица пользователей -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Пользователи</h3>
                    <div class="card-tools">
                        <a href="{{ route('boss.users.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Создать пользователя
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('boss.users.index') }}" method="GET" class="form-inline">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Поиск..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="form-inline float-right">
                                <form action="{{ route('boss.users.index') }}" method="GET" class="mr-2">
                                    <input type="hidden" name="role" value="{{ request('role') }}">
                                    <select name="per_page" class="form-control" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 записей</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 записей</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 записей</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 записей</option>
                                    </select>
                                </form>
                                <form action="{{ route('boss.users.index') }}" method="GET">
                                    <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                                    <select name="role" class="form-control" onchange="this.form.submit()">
                                        <option value="">Все роли</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Администраторы</option>
                                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Пользователи</option>
                                        <option value="partner" {{ request('role') == 'partner' ? 'selected' : '' }}>Партнеры</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>
                                        <button class="btn btn-sm btn-link text-dark copy-email" data-toggle="tooltip" title="Копировать email">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </th>
                                    <th>Телефон</th>
                                    <th>
                                        <button class="btn btn-sm btn-link text-dark" data-toggle="tooltip" title="Открыть в Telegram">
                                            <i class="fab fa-telegram"></i>
                                        </button>
                                    </th>
                                    <th>Роль</th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'balance', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-dark">
                                            Баланс
                                            @if(request('sort') == 'balance')
                                                <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_spent', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-dark">
                                            Общая сумма
                                            @if(request('sort') == 'total_spent')
                                                <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'repeat_purchases', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-dark">
                                            LTV
                                            @if(request('sort') == 'repeat_purchases')
                                                <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'payment_rating', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-dark">
                                            Рейтинг
                                            @if(request('sort') == 'payment_rating')
                                                <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary copy-email" 
                                                data-email="{{ $user->email }}"
                                                data-toggle="tooltip" 
                                                title="{{ $user->email }}">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if($user->telegram_username)
                                            <a href="https://t.me/{{ str_replace('@', '', $user->telegram_username) }}" 
                                               class="btn btn-sm btn-outline-info"
                                               target="_blank"
                                               data-toggle="tooltip" 
                                               title="Открыть в Telegram">
                                                <i class="fab fa-telegram"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'partner' ? 'success' : 'info') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($user->balance, 2, ',', ' ') }}</td>
                                    <td>{{ number_format($user->total_spent, 2, ',', ' ') }}</td>
                                    <td>{{ $user->repeat_purchases }}</td>
                                    <td>
                                        @if($user->payment_rating < 50)
                                            <span class="text-danger">{{ number_format($user->payment_rating, 1) }}%</span>
                                        @elseif($user->payment_rating < 90)
                                            <span class="text-warning">{{ number_format($user->payment_rating, 1) }}%</span>
                                        @else
                                            <span class="text-success">{{ number_format($user->payment_rating, 1) }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('boss.users.edit', $user) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('boss.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Вы уверены?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th a {
        text-decoration: none;
    }
    .table th a:hover {
        color: #007bff !important;
    }
    .pagination {
        margin-bottom: 0;
    }
    .pagination .page-item .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .pagination .page-item .page-link:hover {
        background-color: #e9ecef;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация тултипов
    $('[data-toggle="tooltip"]').tooltip();

    // Копирование email
    document.querySelectorAll('.copy-email').forEach(button => {
        button.addEventListener('click', function() {
            const email = this.dataset.email;
            navigator.clipboard.writeText(email).then(() => {
                const tooltip = $(this).tooltip();
                const originalTitle = tooltip.attr('data-original-title');
                tooltip.attr('data-original-title', 'Скопировано!').tooltip('show');
                setTimeout(() => {
                    tooltip.attr('data-original-title', originalTitle);
                }, 1000);
            });
        });
    });

    // Инициализация графика
    const ctx = document.getElementById('registrationChart').getContext('2d');
    const registrationData = @json($registrationStats);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: registrationData.map(item => item.month),
            datasets: [{
                label: 'Количество регистраций',
                data: registrationData.map(item => item.count),
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>
@endpush 