<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XO4U-SERVIS - Административная панель</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">
                        <i class="fas fa-sign-out-alt"></i> Выход
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('boss.dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">XO4U-SERVIS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('boss.dashboard') }}" class="nav-link {{ request()->routeIs('boss.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Личный кабинет</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('boss.settings') }}" class="nav-link {{ request()->routeIs('boss.settings') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Общие настройки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('boss.accounts.index') }}" class="nav-link {{ request()->routeIs('boss.accounts.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>Аккаунты клиентов</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('boss.users.index') }}" class="nav-link {{ request()->routeIs('boss.users.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Пользователи</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('boss.site-templates.index') }}" class="nav-link {{ request()->routeIs('boss.site-templates.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-paint-brush"></i>
                            <p>Шаблоны сайтов</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('boss.direct-templates.index') }}" class="nav-link {{ request()->routeIs('boss.direct-templates.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-ad"></i>
                            <p>Шаблоны Яндекс.Директ</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ request()->routeIs('boss.api.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('boss.api.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-plug"></i>
                            <p>
                                API
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('boss.api.yandex-direct') }}" class="nav-link {{ request()->routeIs('boss.api.yandex-direct') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Яндекс.Директ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('boss.api.yandex-metrika') }}" class="nav-link {{ request()->routeIs('boss.api.yandex-metrika') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Яндекс.Метрика</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('boss.api.yandex-yookassa') }}" class="nav-link {{ request()->routeIs('boss.api.yandex-yookassa') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ЮKassa</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('boss.payments.index') }}" class="nav-link {{ request()->routeIs('boss.payments.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Оплаты и транзакции</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('boss.logs.index') }}" class="nav-link {{ request()->routeIs('boss.logs.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-exclamation-triangle"></i>
                            <p>Лог ошибок</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                @yield('header')
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }} XO4U-SERVIS.</strong>
        Все права защищены.
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html> 