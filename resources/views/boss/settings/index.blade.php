@extends('boss.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Общие настройки сервиса</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('boss.settings.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="site_name">Название сайта</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="site_description">Описание сайта</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ old('site_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="contact_email">Контактный email</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
                        </div>
                        <div class="form-group">
                            <label for="contact_phone">Контактный телефон</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить настройки</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 