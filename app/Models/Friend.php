<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Friend extends Model
{
    protected $table = 'friends';

    protected $fillable = [
        'user_id',
        'friend_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'friend_id', 'id');
    }

    public function givePoints()
    {
        return $this->hasMany(GivePoint::class, 'receive_user_id', 'friend_id');
    }

    public function latestSendChatMessage()
    {
        $userId = Auth::id();
        return $this->hasOne(ChatMessage::class, 'receive_user_id', 'friend_id')
                    ->where('send_user_id', $userId)
                    ->orderBy('id', 'desc');
    }

    public function latestReceiveChatMessage()
    {
        $userId = Auth::id();
        return $this->hasOne(ChatMessage::class, 'send_user_id', 'friend_id')
                    ->where('receive_user_id', $userId)
                    ->orderBy('id', 'desc');
    }
}
