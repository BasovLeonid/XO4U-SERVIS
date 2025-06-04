<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'types',
        'strategy',
        'image'
    ];

    protected $casts = [
        'types' => 'array'
    ];

    public function campaigns()
    {
        return $this->hasMany(DirectTemplatesCampaign::class, 'template_id');
    }
} 