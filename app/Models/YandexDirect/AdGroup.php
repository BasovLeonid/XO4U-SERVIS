<?php

namespace App\YandexDirect\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdGroup extends Model
{
    protected $table = 'direct_templates_ad_groups';

    protected $fillable = [
        'name',
        'status',
        'type',
        'campaign_id',
        'settings',
        'content'
    ];

    protected $casts = [
        'settings' => 'array',
        'content' => 'array'
    ];

    /**
     * Получить кампанию, к которой принадлежит группа
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    /**
     * Получить объявления группы
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class, 'ad_group_id');
    }

    /**
     * Получить ключевые слова группы
     */
    public function keywords(): HasMany
    {
        return $this->hasMany(Keyword::class, 'ad_group_id');
    }

    /**
     * Получить настройки группы
     */
    public function getSettingsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Установить настройки группы
     */
    public function setSettingsAttribute($value)
    {
        $this->attributes['settings'] = json_encode($value);
    }

    /**
     * Получить содержимое группы
     */
    public function getContentAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Установить содержимое группы
     */
    public function setContentAttribute($value)
    {
        $this->attributes['content'] = json_encode($value);
    }

    /**
     * Валидация содержимого группы
     */
    public function validateContent()
    {
        // Реализация валидации содержимого
    }

    /**
     * Валидация настроек группы
     */
    public function validateSettings()
    {
        // Реализация валидации настроек
    }

    /**
     * Получить статистику группы
     */
    public function getStatistics()
    {
        // Реализация получения статистики
    }

    /**
     * Обновить статус группы
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