<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirectTemplateAd extends Model
{
    protected $fillable = [
        'ad_group_template_id',
        'type',
        'settings',
        'content',
    ];

    protected $casts = [
        'settings' => 'array',
        'content' => 'array',
    ];

    public function adGroup(): BelongsTo
    {
        return $this->belongsTo(DirectTemplateAdGroup::class, 'ad_group_template_id');
    }
} 