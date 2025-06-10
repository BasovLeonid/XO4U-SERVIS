<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignExclusion extends Model
{
    use SoftDeletes;

    protected $table = 'direct_campaign_exclusions';

    protected $fillable = [
        'direct_campaign_id',
        'yandex_campaign_id',
        'blocked_ips',
        'excluded_sites',
        'setting_param'
    ];

    protected $casts = [
        'blocked_ips' => 'array',
        'excluded_sites' => 'array',
        'setting_param' => 'array'
    ];

    /**
     * Получить кампанию, к которой относятся исключения
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }
} 