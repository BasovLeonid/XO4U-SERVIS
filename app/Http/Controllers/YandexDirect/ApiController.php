<?php

namespace App\Http\Controllers\YandexDirect;

use App\Http\Controllers\Controller;
use App\Models\YandexDirect\AccountSettingApi;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function connect(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|string',
            'client_secret' => 'required|string'
        ]);

        // TODO: Реализовать подключение к API Яндекс.Директ
        $accountSettings = AccountSettingApi::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()
            ->route('yandex-direct.settings.api')
            ->with('success', 'Успешное подключение к API');
    }

    public function disconnect()
    {
        AccountSettingApi::truncate();

        return redirect()
            ->route('yandex-direct.settings.api')
            ->with('success', 'Отключение от API выполнено');
    }

    public function refresh()
    {
        // TODO: Реализовать обновление токенов
        return redirect()
            ->route('yandex-direct.settings.api')
            ->with('success', 'Токены успешно обновлены');
    }

    public function status()
    {
        $accountSettings = AccountSettingApi::first();
        $isConnected = $accountSettings && $accountSettings->access_token;

        return response()->json([
            'connected' => $isConnected,
            'expires_at' => $accountSettings ? $accountSettings->expires_at : null
        ]);
    }
} 