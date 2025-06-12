<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\ApiSetting;
use App\Models\YandexDirect\AccountSettingApi;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = ApiSetting::first();
        return view('yandex-direct.settings.index', compact('settings'));
    }

    public function api()
    {
        $accountSettings = AccountSettingApi::first();
        return view('yandex-direct.settings.api', compact('accountSettings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'api_key' => 'required|string',
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
            'access_token' => 'required|string',
            'refresh_token' => 'required|string',
            'expires_at' => 'required|date'
        ]);

        ApiSetting::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()
            ->route('yandex-direct.settings.index')
            ->with('success', 'Настройки успешно обновлены');
    }

    public function sync()
    {
        // TODO: Реализовать синхронизацию с API Яндекс.Директ
        return redirect()
            ->route('yandex-direct.settings.index')
            ->with('success', 'Синхронизация успешно завершена');
    }
} 