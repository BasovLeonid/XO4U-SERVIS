<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'subtype',
        'login',
        'password',
        'oauth_token',
        'status',
        'user_id',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeNameAttribute()
    {
        return [
            'yandex' => 'Яндекс Директ',
            'vk' => 'ВК Реклама',
        ][$this->type] ?? $this->type;
    }

    public function getSubtypeNameAttribute()
    {
        return [
            'created' => 'Созданный нами',
            'added' => 'Добавленный пользователем',
        ][$this->subtype] ?? $this->subtype;
    }

    public function getStatusNameAttribute()
    {
        return [
            'active' => 'Активный',
            'archived' => 'Архивный',
            'paused' => 'Приостановленный',
        ][$this->status] ?? $this->status;
    }

    public function getStatusClassAttribute()
    {
        return [
            'active' => 'success',
            'archived' => 'secondary',
            'paused' => 'warning',
        ][$this->status] ?? 'secondary';
    }
}
