<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
