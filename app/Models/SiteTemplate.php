<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SiteTemplate extends Model
{
    protected $fillable = [
        'name',
        'template_code',
        'description',
        'preview_image',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function blocks(): HasMany
    {
        return $this->hasMany(SiteTemplateBlock::class);
    }

    public function variables(): HasMany
    {
        return $this->hasMany(SiteTemplateVariable::class);
    }

    public function instances(): HasMany
    {
        return $this->hasMany(SiteInstance::class);
    }

    public function getConfigPath(): string
    {
        return storage_path("app/store/site_templates/{$this->template_code}/config.json");
    }

    public function getTemplatePath(): string
    {
        return storage_path("app/store/site_templates/{$this->template_code}/template.blade.php");
    }

    public function getAssetsPath(): string
    {
        return storage_path("app/store/site_templates/{$this->template_code}/assets");
    }
} 