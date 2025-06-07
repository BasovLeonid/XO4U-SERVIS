<?php

namespace App\YandexDirect\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ad extends Model
{
    protected $table = 'direct_templates_ads';

    protected $fillable = [
        'name',
        'status',
        'type',
        'campaign_id',
        'ad_group_id',
        'content',
        'settings'
    ];

    protected $casts = [
        'content' => 'array',
        'settings' => 'array'
    ];

    /**
     * Получить кампанию объявления
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    /**
     * Получить группу объявления
     */
    public function adGroup(): BelongsTo
    {
        return $this->belongsTo(AdGroup::class, 'ad_group_id');
    }

    /**
     * Получить расширения объявления
     */
    public function extensions(): HasMany
    {
        return $this->hasMany(AdExtension::class, 'ad_id');
    }

    /**
     * Получить модификаторы объявления
     */
    public function modifiers(): HasMany
    {
        return $this->hasMany(BidModifier::class, 'ad_id');
    }

    /**
     * Получить содержимое объявления
     */
    public function getContentAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Установить содержимое объявления
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = json_encode($value);
    }

    /**
     * Получить настройки объявления
     */
    public function getSettingsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Установить настройки объявления
     */
    public function setSettingsAttribute($value)
    {
        $this->attributes['settings'] = json_encode($value);
    }

    /**
     * Валидация содержимого объявления
     */
    public function validateContent()
    {
        // Реализация валидации содержимого
    }

    /**
     * Валидация настроек объявления
     */
    public function validateSettings()
    {
        // Реализация валидации настроек
    }

    /**
     * Получить статистику объявления
     */
    public function getStatistics()
    {
        // Реализация получения статистики
    }

    /**
     * Обновить статус объявления
     */
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    /**
     * Синхронизация с Яндекс.Директ
     */
    public function syncWithYandex()
    {
        // Реализация синхронизации
    }
} 