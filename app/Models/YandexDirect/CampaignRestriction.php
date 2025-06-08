<?php

namespace App\Models\YandexDirect;

use Illuminate\Database\Eloquent\Model;

class CampaignRestriction extends Model
{
    protected $fillable = [
        'campaign_id',
        'negative_keywords',
        'excluded_sites',
        'blocked_ips'
    ];

    protected $casts = [
        'negative_keywords' => 'array',
        'excluded_sites' => 'array',
        'blocked_ips' => 'array'
    ];

    /**
     * Валидация данных
     *
     * @param array $data
     * @return array
     */
    public static function validate(array $data): array
    {
        return validator($data, [
            'campaign_id' => 'required|integer|exists:campaigns,id',
            'negative_keywords' => 'nullable|array',
            'negative_keywords.*' => 'string|max:255',
            'excluded_sites' => 'nullable|array',
            'excluded_sites.*' => 'url',
            'blocked_ips' => 'nullable|array',
            'blocked_ips.*' => 'ip'
        ])->validate();
    }
} 