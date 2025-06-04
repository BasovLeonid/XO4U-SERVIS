@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Таблица аккаунтов -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Рекламные аккаунты</h3>
                    <div class="card-tools">
                        <a href="{{ route('boss.accounts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Создать аккаунт
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('boss.accounts.index') }}" method="GET" class="form-inline">
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
                                <form action="{{ route('boss.accounts.index') }}" method="GET" class="mr-2">
                                    <input type="hidden" name="type" value="{{ request('type') }}">
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                    <select name="per_page" class="form-control" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 записей</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 записей</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 записей</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 записей</option>
                                    </select>
                                </form>
                                <form action="{{ route('boss.accounts.index') }}" method="GET" class="mr-2">
                                    <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                    <select name="type" class="form-control" onchange="this.form.submit()">
                                        <option value="">Все типы</option>
                                        <option value="yandex" {{ request('type') == 'yandex' ? 'selected' : '' }}>Yandex Direct</option>
                                        <option value="vk" {{ request('type') == 'vk' ? 'selected' : '' }}>VK Advertising</option>
                                    </select>
                                </form>
                                <form action="{{ route('boss.accounts.index') }}" method="GET">
                                    <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                                    <input type="hidden" name="type" value="{{ request('type') }}">
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="">Все статусы</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Активные</option>
                                        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Архивные</option>
                                        <option value="paused" {{ request('status') == 'paused' ? 'selected' : '' }}>На паузе</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Тип</th>
                                    <th>Подтип</th>
                                    <th>Логин</th>
                                    <th>Статус</th>
                                    <th>Пользователь</th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'balance', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-dark">
                                            Баланс
                                            @if(request('sort') == 'balance')
                                                <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accounts as $account)
                                <tr>
                                    <td>{{ $account->id }}</td>
                                    <td>{{ $account->type_name }}</td>
                                    <td>{{ $account->subtype_name }}</td>
                                    <td>{{ $account->login }}</td>
                                    <td>
                                        <span class="badge badge-{{ $account->status_class }}">
                                            {{ $account->status_name }}
                                        </span>
                                    </td>
                                    <td>{{ $account->user->name ?? 'Не назначен' }}</td>
                                    <td>{{ number_format($account->balance, 2, ',', ' ') }}</td>
                                    <td>
                                        <a href="{{ route('boss.accounts.edit', $account) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('boss.accounts.destroy', $account) }}" method="POST" class="d-inline">
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
                        {{ $accounts->appends(request()->query())->links('pagination::bootstrap-4') }}
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
</style>
@endpush 