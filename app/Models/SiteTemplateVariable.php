<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiteTemplateVariable extends Model
{
    protected $fillable = [
        'site_template_id',
        'name',
        'variable_code',
        'type',
        'default_value',
        'validation_rules',
        'is_required',
    ];

    protected $casts = [
        'validation_rules' => 'array',
        'is_required' => 'boolean',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(SiteTemplate::class, 'site_template_id');
    }

    public function getValidationRules(): array
    {
        $rules = $this->validation_rules ?? [];
        
        if ($this->is_required) {
            $rules[] = 'required';
        } else {
            $rules[] = 'nullable';
        }

        return $rules;
    }
} 