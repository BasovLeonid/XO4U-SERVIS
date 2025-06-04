<?php

namespace App\Http\Controllers\Boss;

use App\Http\Controllers\Controller;
use App\Models\ApiSetting;
use Illuminate\Http\Request;

class YandexMetrikaController extends Controller
{
    public function index()
    {
        $settings = ApiSetting::getServiceSettings(ApiSetting::SERVICE_YANDEX_METRIKA);
        
        if (!$settings) {
            // Если настройки не найдены, создаем их с дефолтными значениями
            $settings = ApiSetting::create([
                'service' => ApiSetting::SERVICE_YANDEX_METRIKA,
                'client_id' => '4b516980adea471abbe91d5e9b7d6634',
                'client_secret' => '8d0267598b0340adb0d751700ba7eaf7',
                'redirect_uri' => 'https://oauth.yandex.ru/verification_code'
            ]);
        }

        $authUrl = "https://oauth.yandex.ru/authorize?response_type=token&client_id={$settings->client_id}";

        return view('boss.yandex-metrika.index', [
            'clientId' => $settings->client_id,
            'clientSecret' => $settings->client_secret,
            'redirectUri' => $settings->redirect_uri,
            'authUrl' => $authUrl,
            'isConnected' => $settings->isTokenValid()
        ]);
    }

    public function update(Request $request)
    {
        $settings = ApiSetting::getServiceSettings(ApiSetting::SERVICE_YANDEX_METRIKA);
        
        $validated = $request->validate([
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
            'redirect_uri' => 'required|url'
        ]);

        $settings->update($validated);

        return redirect()->back()->with('success', 'Настройки успешно обновлены');
    }
} 