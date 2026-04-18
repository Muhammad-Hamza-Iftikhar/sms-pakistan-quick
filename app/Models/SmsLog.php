<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_phone',
        'message',
        'provider',
        'provider_message_id',
        'status',
        'error_message',
        'provider_response',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'provider_response' => 'array',
            'sent_at' => 'datetime',
        ];
    }
}

