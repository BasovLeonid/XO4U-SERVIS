<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DirectTemplateCampaign extends Model
{
    protected $fillable = [
        'name',
        'status',
        'url',
        'metrika_counter_id',
        'goals',
    ];

    protected $casts = [
        'goals' => 'array',
    ];

    public function adGroups(): HasMany
    {
        return $this->hasMany(DirectTemplateAdGroup::class, 'campaign_template_id');
    }

    public function adExtensions(): HasMany
    {
        return $this->hasMany(DirectTemplateAdExtension::class, 'campaign_template_id');
    }

    public function audiences(): HasMany
    {
        return $this->hasMany(DirectTemplateAudience::class, 'campaign_template_id');
    }

    public function feeds(): HasMany
    {
        return $this->hasMany(DirectTemplateFeed::class, 'campaign_template_id');
    }

    public function template()
    {
        return $this->belongsTo(DirectTemplate::class, 'direct_template_id');
    }
} 