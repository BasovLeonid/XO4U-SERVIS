<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteInstance extends Model
{
    protected $fillable = [
        'site_template_id',
        'user_id',
        'name',
        'domain',
        'status',
        'variables',
    ];

    protected $casts = [
        'variables' => 'array',
        'status' => 'string',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(SiteTemplate::class, 'site_template_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getVariable(string $code, $default = null)
    {
        return $this->variables[$code] ?? $default;
    }

    public function setVariable(string $code, $value): void
    {
        $variables = $this->variables ?? [];
        $variables[$code] = $value;
        $this->variables = $variables;
    }
} 