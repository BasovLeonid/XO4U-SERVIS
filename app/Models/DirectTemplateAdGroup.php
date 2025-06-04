<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DirectTemplateAdGroup extends Model
{
    protected $fillable = [
        'campaign_template_id',
        'name',
        'type',
        'settings',
        'targeting',
    ];

    protected $casts = [
        'settings' => 'array',
        'targeting' => 'array',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(DirectTemplateCampaign::class, 'campaign_template_id');
    }

    public function ads(): HasMany
    {
        return $this->hasMany(DirectTemplateAd::class, 'ad_group_template_id');
    }

    public function keywords(): HasMany
    {
        return $this->hasMany(DirectTemplateKeyword::class, 'ad_group_template_id');
    }

    public function bidModifiers(): HasMany
    {
        return $this->hasMany(DirectTemplateBidModifier::class, 'ad_group_template_id');
    }
} 