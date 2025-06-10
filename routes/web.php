<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SiteTemplateController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Lk\DashboardController as LkDashboardController;
use App\Http\Controllers\Boss\DashboardController as BossDashboardController;
use App\Http\Controllers\Boss\SettingController;
use App\Http\Controllers\Boss\UserController;
use App\Http\Controllers\Boss\AccountController;
use App\Http\Controllers\Boss\SiteTemplateController as BossSiteTemplateController;
use App\Http\Controllers\Boss\DirectTemplateController;
use App\Http\Controllers\Boss\DirectTemplatesCampaignController;
use App\Http\Controllers\Boss\ApiController;
use App\Http\Controllers\Boss\PaymentController;
use App\Http\Controllers\Boss\LogController;
use App\Http\Controllers\Boss\YandexDirectController;
use App\Http\Controllers\Boss\YandexMetrikaController;
use App\Http\Controllers\Boss\DirectTemplatesAdGroupController;
use App\Http\Controllers\Boss\CampaignController;
use App\Http\Controllers\YandexDirect\CampaignController as YandexDirectCampaignController;

// Публичные маршруты
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// 🔐 Аутентификация (Auth scaffolding)
require __DIR__.'/auth.php';

// Маршруты личного кабинета
Route::middleware(['auth'])->prefix('lk')->name('lk.')->group(function () {
    Route::get('/', [LkDashboardController::class, 'index'])->name('dashboard');
    Route::get('/projects', [LkDashboardController::class, 'projects'])->name('projects.index');
    Route::get('/accounts', [LkDashboardController::class, 'accounts'])->name('accounts.index');
    Route::get('/leads', [LkDashboardController::class, 'leads'])->name('leads.index');
    Route::get('/finance', [LkDashboardController::class, 'finance'])->name('finance.index');
    Route::get('/clients', [LkDashboardController::class, 'clients'])->name('clients.index');
    Route::get('/profile', [LkDashboardController::class, 'profile'])->name('profile.edit');
});

// Маршруты административной части
Route::middleware(['auth', 'verified'])->prefix('boss')->name('boss.')->group(function () {
    Route::get('/', [BossDashboardController::class, 'index'])->name('dashboard');
    
    // Настройки
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Аккаунты клиентов
    Route::resource('accounts', AccountController::class);
    
    // Пользователи
    Route::resource('users', UserController::class);
    
    // Шаблоны сайтов
    Route::get('site-templates/{siteTemplate}/preview', [BossSiteTemplateController::class, 'preview'])
        ->name('site-templates.preview');
    Route::resource('site-templates', BossSiteTemplateController::class);
    
    // Шаблоны Яндекс.Директ
    Route::resource('direct-templates', DirectTemplateController::class);
    
    // Маршруты для кампаний
    Route::prefix('direct-templates')->name('direct-templates.')->group(function () {
        Route::prefix('{template}/campaigns')->name('campaigns.')->group(function () {
        });
    });
    
    // API
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/', [ApiController::class, 'index'])->name('index');
        Route::get('/yandex-direct', [YandexDirectController::class, 'index'])->name('yandex-direct');
        Route::post('/yandex-direct', [ApiController::class, 'updateYandexDirect'])->name('yandex-direct.update');
        
        Route::get('/yandex-metrika', [YandexMetrikaController::class, 'index'])->name('yandex-metrika');
        Route::post('/yandex-metrika', [ApiController::class, 'updateYandexMetrika'])->name('yandex-metrika.update');
        
        Route::get('/yandex-yookassa', [ApiController::class, 'yandexYookassa'])->name('yandex-yookassa');
        Route::post('/yandex-yookassa', [ApiController::class, 'updateYandexYookassa'])->name('yandex-yookassa.update');
    });
    
    // Оплаты и транзакции
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    
    // Лог ошибок
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::get('/logs/{log}', [LogController::class, 'show'])->name('logs.show');
});

// Маршруты Яндекс.Директ
Route::prefix('yandex-direct')->name('yandex-direct.')->group(function () {
    // Кампании
    Route::get('campaigns/{campaign}/settings', [CampaignController::class, 'settings'])
        ->name('campaigns.settings');
    Route::put('campaigns/{campaign}/settings', [CampaignController::class, 'updateSettings'])
        ->name('campaigns.update-settings');
});

// Маршруты интерфейсов
Route::prefix('interface')->name('interface.')->group(function () {
    // Маршруты Яндекс.Директ
    Route::prefix('yandex-direct')->name('yandex-direct.')->group(function () {
        Route::get('create', [YandexDirectCampaignController::class, 'create'])
            ->name('create');
        Route::get('{campaign}/settings', [YandexDirectCampaignController::class, 'settings'])
            ->name('settings')
            ->where('campaign', '[0-9]+');
        Route::put('{campaign}/settings', [YandexDirectCampaignController::class, 'updateSettings'])
            ->name('update-settings')
            ->where('campaign', '[0-9]+');
        Route::post('{campaign}/settings', [YandexDirectCampaignController::class, 'updateSettingsSection'])
            ->name('update-settings-section')
            ->where('campaign', '[0-9]+');
        Route::delete('{campaign}', [YandexDirectCampaignController::class, 'destroy'])
            ->name('destroy')
            ->where('campaign', '[0-9]+');
    });
});

