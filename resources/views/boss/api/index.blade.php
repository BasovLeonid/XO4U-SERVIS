@extends('boss.layouts.app')

@section('title', 'Настройки API')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="h3 mb-0">Настройки API</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Яндекс.Директ</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('boss.api.yandex-direct.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="yandex_direct_token" class="form-label">Токен доступа</label>
                            <input type="text" class="form-control" id="yandex_direct_token" name="token" value="{{ old('token') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Яндекс.Метрика</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('boss.api.yandex-metrika.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="yandex_metrika_token" class="form-label">Токен доступа</label>
                            <input type="text" class="form-control" id="yandex_metrika_token" name="token" value="{{ old('token') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">ЮKassa</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('boss.api.yandex-yookassa.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="yookassa_shop_id" class="form-label">ID магазина</label>
                            <input type="text" class="form-control" id="yookassa_shop_id" name="shop_id" value="{{ old('shop_id') }}">
                        </div>
                        <div class="mb-3">
                            <label for="yookassa_secret_key" class="form-label">Секретный ключ</label>
                            <input type="password" class="form-control" id="yookassa_secret_key" name="secret_key" value="{{ old('secret_key') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 