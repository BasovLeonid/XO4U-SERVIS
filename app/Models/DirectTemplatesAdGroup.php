<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectTemplatesAdGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_template_id',
        'name',
        'type',
        'settings',
        'targeting',
    ];

    public function campaign()
    {
        return $this->belongsTo(DirectTemplatesCampaign::class, 'campaign_template_id');
    }

    public function ads()
    {
        return $this->hasMany(DirectTemplatesAd::class, 'ad_group_template_id');
    }
} 