<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    protected $table = 'direct_templates_campaigns';

    protected $fillable = [
        'name',
        'status',
        'type',
        'budget',
        'strategy',
        'platforms',
        'schedule',
        'restrictions',
        'corrections',
        'additional_settings',
        'template_id'
    ];

    protected $casts = [
        'platforms' => 'array',
        'schedule' => 'array',
        'restrictions' => 'array',
        'corrections' => 'array',
        'additional_settings' => 'array'
    ];

    /**
     * Получить шаблон, к которому принадлежит кампания
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    /**
     * Получить группы объявлений кампании
     */
    public function adGroups(): HasMany
    {
        return $this->hasMany(AdGroup::class, 'campaign_id');
    }

    /**
     * Получить объявления кампании
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class, 'campaign_id');
    }

    /**
     * Получить модификаторы ставок кампании
     */
    public function bidModifiers(): HasMany
    {
        return $this->hasMany(BidModifier::class, 'campaign_id');
    }

    /**
     * Получить ключевые слова кампании
     */
    public function keywords(): HasMany
    {
        return $this->hasMany(Keyword::class, 'campaign_id');
    }

    /**
     * Получить логи кампании
     */
    public function logs(): HasMany
    {
        return $this->hasMany(CampaignLog::class, 'campaign_id');
    }

    /**
     * Получить аналитику кампании
     */
    public function analytics(): HasMany
    {
        return $this->hasMany(CampaignAnalytics::class, 'campaign_id');
    }

    /**
     * Получить статус синхронизации кампании
     */
    public function sync(): HasMany
    {
        return $this->hasMany(CampaignSync::class, 'campaign_id');
    }

    /**
     * Область видимости для активных кампаний
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Область видимости для кампаний по шаблону
     */
    public function scopeByTemplate($query, $templateId)
    {
        return $query->where('template_id', $templateId);
    }

    /**
     * Получить платформы кампании
     */
    public function getPlatformsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Установить платформы кампании
     */
    public function setPlatformsAttribute($value)
    {
        $this->attributes['platforms'] = json_encode($value);
    }

    /**
     * Получить расписание кампании
     */
    public function getScheduleAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Установить расписание кампании
     */
    public function setScheduleAttribute($value)
    {
        $this->attributes['schedule'] = json_encode($value);
    }

    /**
     * Валидация стратегии кампании
     */
    public function validateStrategy()
    {
        // Реализация валидации стратегии
    }

    /**
     * Валидация платформ кампании
     */
    public function validatePlatforms()
    {
        // Реализация валидации платформ
    }

    /**
     * Валидация бюджета кампании
     */
    public function validateBudget()
    {
        // Реализация валидации бюджета
    }

    /**
     * Получить статистику кампании
     */
    public function getStatistics()
    {
        // Реализация получения статистики
    }

    /**
     * Синхронизация с Яндекс.Директ
     */
    public function syncWithYandex()
    {
        // Реализация синхронизации
    }

    /**
     * Экспорт данных кампании
     */
    public function exportData()
    {
        // Реализация экспорта
    }

    /**
     * Импорт данных кампании
     */
    public function importData($data)
    {
        // Реализация импорта
    }
} 