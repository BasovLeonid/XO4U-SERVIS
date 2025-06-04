<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirectTemplateFeed extends Model
{
    protected $fillable = [
        'campaign_template_id',
        'name',
        'business_type',
        'source_type',
        'url_feed',
        'file_feed',
    ];

    protected $casts = [
        'url_feed' => 'array',
        'file_feed' => 'array',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(DirectTemplateCampaign::class, 'campaign_template_id');
    }
} 