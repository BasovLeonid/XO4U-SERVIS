<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignNegativeKeyword extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaign_negative_keywords';

    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'yandex_ad_group_id',
        'negative_keywords',
        'setting_param'
    ];

    protected $casts = [
        'negative_keywords' => 'array',
        'setting_param' => 'array'
    ];

    /**
     * Получить кампанию, к которой относятся минус-слова
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }
} 