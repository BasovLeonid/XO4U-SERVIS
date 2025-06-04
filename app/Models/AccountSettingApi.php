<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountSettingApi extends Model
{
    use HasFactory;

    protected $table = 'account_setting_api';

    protected $fillable = [
        'type',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];
}
