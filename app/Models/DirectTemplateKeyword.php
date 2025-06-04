<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirectTemplateKeyword extends Model
{
    protected $fillable = [
        'ad_group_template_id',
        'keyword',
        'type',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function adGroup(): BelongsTo
    {
        return $this->belongsTo(DirectTemplateAdGroup::class, 'ad_group_template_id');
    }
} 