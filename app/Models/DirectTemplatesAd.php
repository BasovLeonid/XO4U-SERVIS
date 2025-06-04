<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectTemplatesAd extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_group_template_id',
        'type',
        'settings',
        'content',
    ];

    public function adGroup()
    {
        return $this->belongsTo(DirectTemplatesAdGroup::class, 'ad_group_template_id');
    }
} 