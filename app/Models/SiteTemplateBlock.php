<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteTemplateBlock extends Model
{
    protected $fillable = [
        'site_template_id',
        'name',
        'block_code',
        'content',
        'order',
        'is_required',
    ];

    protected $casts = [
        'content' => 'array',
        'is_required' => 'boolean',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(SiteTemplate::class, 'site_template_id');
    }

    public function getBlockPath(): string
    {
        return storage_path("app/store/site_templates/{$this->template->template_code}/blocks/{$this->block_code}.blade.php");
    }
} 