<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $fillable = [
        'send_user_id',
        'receive_user_id',
        'message',
        'stamp',
        'image',
    ];
}
