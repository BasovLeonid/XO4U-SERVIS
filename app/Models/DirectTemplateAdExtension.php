<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirectTemplateAdExtension extends Model
{
    protected $fillable = [
        'campaign_template_id',
        'type',
        'settings',
        'content',
    ];

    protected $casts = [
        'settings' => 'array',
        'content' => 'array',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(DirectTemplateCampaign::class, 'campaign_template_id');
    }
} 