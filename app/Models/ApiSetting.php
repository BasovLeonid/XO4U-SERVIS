<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiSetting extends Model
{
    protected $fillable = [
        'service',
        'client_id',
        'client_secret',
        'redirect_uri',
        'access_token',
        'refresh_token',
        'token_expires_at'
    ];

    protected $casts = [
        'token_expires_at' => 'datetime'
    ];

    // Константы для сервисов
    const SERVICE_YANDEX_DIRECT = 'yandex_direct';
    const SERVICE_YANDEX_METRIKA = 'yandex_metrika';
    const SERVICE_YANDEX_YOOKASSA = 'yandex_yookassa';

    // Получить настройки для конкретного сервиса
    public static function getServiceSettings($service)
    {
        return static::where('service', $service)->first();
    }

    // Проверить, действителен ли токен
    public function isTokenValid()
    {
        return $this->access_token && 
               $this->token_expires_at && 
               $this->token_expires_at->isFuture();
    }

    // Обновить токены
    public function updateTokens($accessToken, $refreshToken = null, $expiresIn = null)
    {
        $this->access_token = $accessToken;
        
        if ($refreshToken) {
            $this->refresh_token = $refreshToken;
        }
        
        if ($expiresIn) {
            $this->token_expires_at = now()->addSeconds($expiresIn);
        }
        
        $this->save();
    }
} 