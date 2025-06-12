<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaigns';

    protected $fillable = [
        'type',
        'template_id',
        'user_id',
        'account_id',
        'url',
        'summary',
        'user_param',
        'template_param',
        'setting_param',
        'name',
        'yandex_campaign_id',
        'status',
        'daily_budget_amount',
        'daily_budget_mode',
        'search_result',
        'dynamic_places',
        'product_gallery',
        'search_organization_list',
        'network',
        'maps'
    ];

    protected $casts = [
        'summary' => 'array',
        'user_param' => 'array',
        'template_param' => 'array',
        'setting_param' => 'array',
        'daily_budget_amount' => 'decimal:6'
    ];

    /**
     * Получить шаблон, к которому принадлежит кампания
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    /**
     * Получить пользователя, которому принадлежит кампания
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить аккаунт, к которому принадлежит кампания
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
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
     * Получить настройки кампании
     */
    public function settings(): HasOne
    {
        return $this->hasOne(CampaignSetting::class, 'direct_campaign_id');
    }

    /**
     * Получить поисковую стратегию кампании
     */
    public function searchStrategies(): HasOne
    {
        return $this->hasOne(CampaignSearchStrategy::class, 'direct_campaign_id');
    }

    /**
     * Получить модификаторы ставок кампании
     */
    public function bidAdjustments(): HasOne
    {
        return $this->hasOne(CampaignBidAdjustment::class, 'direct_campaign_id');
    }

    /**
     * Получить исключения кампании
     */
    public function exclusions(): HasOne
    {
        return $this->hasOne(CampaignExclusion::class, 'direct_campaign_id');
    }

    /**
     * Получить метрики кампании
     */
    public function metrics(): HasOne
    {
        return $this->hasOne(CampaignMetric::class, 'direct_campaign_id');
    }

    /**
     * Получить минус-слова кампании
     */
    public function negativeKeywords(): HasOne
    {
        return $this->hasOne(CampaignNegativeKeyword::class, 'direct_campaign_id');
    }

    /**
     * Получить сетевую стратегию кампании
     */
    public function networkStrategies(): HasOne
    {
        return $this->hasOne(CampaignNetworkStrategy::class, 'direct_campaign_id');
    }

    /**
     * Получить расписание кампании
     */
    public function schedule(): HasOne
    {
        return $this->hasOne(CampaignSchedule::class, 'direct_campaign_id');
    }

    /**
     * Получение мест размещения
     */
    public function placements(): HasOne
    {
        return $this->hasOne(CampaignPlacement::class);
    }

    /**
     * Получение корректировок
     */
    public function corrections(): HasOne
    {
        return $this->hasOne(CampaignCorrection::class);
    }

    /**
     * Получение ограничений
     */
     
    //public function restrictions(): HasOne
    //{
    //    return $this->hasOne(CampaignRestriction::class);
    //}

    /**
     * Получение дополнительных настроек
     */
    public function additional(): HasOne
    {
        return $this->hasOne(CampaignAdditional::class);
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


    
     // Валидация данных

    public static function validate(array $data): array
    {
        return validator($data, [
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'url' => 'required|url',
            'status' => 'required|in:draft,active,paused,stopped',
            'daily_budget_amount' => 'required|numeric|min:0',
            'daily_budget_mode' => 'required|in:STANDARD,DISTRIBUTED',
            'search_result' => 'required|in:YES,NO',
            'dynamic_places' => 'required|in:YES,NO',
            'product_gallery' => 'required|in:YES,NO',
            'search_organization_list' => 'required|in:YES,NO',
            'network' => 'required|in:YES,NO',
            'maps' => 'required|in:YES,NO'
        ])->validate();
    }
} 