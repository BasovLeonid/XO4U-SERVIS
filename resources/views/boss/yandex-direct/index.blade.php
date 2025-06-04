@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Настройки подключения Яндекс API</h3>
                </div>
                <div class="card-body">
                    <!-- Информация о приложении -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Информация о приложении</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('boss.api.yandex-direct.update') }}" method="POST">
                                @csrf
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 200px;">Название приложения</th>
                                        <td>xo4u-servis</td>
                                    </tr>
                                    <tr>
                                        <th>Client ID</th>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="client_id" class="form-control" value="{{ $clientId }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary copy-btn" data-copy="{{ $clientId }}" type="button">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Client Secret</th>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="client_secret" class="form-control" value="{{ $clientSecret }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary copy-btn" data-copy="{{ $clientSecret }}" type="button">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Redirect URI</th>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="redirect_uri" class="form-control" value="{{ $redirectUri }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary copy-btn" data-copy="{{ $redirectUri }}" type="button">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i>Сохранить изменения
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Подключение аккаунта -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Подключение аккаунта</h4>
                        </div>
                        <div class="card-body">
                            @if($isConnected)
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle mr-2"></i>Аккаунт подключен
                                </div>
                            @endif

                            <p>Для подключения аккаунта Яндекс к API нашего приложения, перейдите по следующей ссылке:</p>
                            <a href="{{ $authUrl }}" class="btn btn-primary btn-lg btn-block" target="_blank">
                                <i class="fab fa-yandex mr-2"></i>Подключить аккаунт Яндекс
                            </a>
                            
                            <div class="alert alert-info mt-4">
                                <h5><i class="fas fa-info-circle mr-2"></i>Инструкция по подключению:</h5>
                                <ol class="mb-0">
                                    <li>Нажмите на кнопку "Подключить аккаунт Яндекс"</li>
                                    <li>Войдите в свой аккаунт Яндекс, если вы еще не авторизованы</li>
                                    <li>Предоставьте необходимые разрешения для приложения</li>
                                    <li>После успешной авторизации вы будете перенаправлены обратно в приложение</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Копирование значений в буфер обмена
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function() {
            const value = this.dataset.copy;
            navigator.clipboard.writeText(value).then(() => {
                const originalHtml = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(() => {
                    this.innerHTML = originalHtml;
                }, 1000);
            });
        });
    });
});
</script>
@endpush 