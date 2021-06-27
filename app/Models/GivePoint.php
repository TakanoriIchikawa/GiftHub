<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GivePoint extends Model
{
    protected $table = 'give_points';

    protected $fillable = [
        'give_point',
        'give_user_id',
        'receive_user_id',
        'signature',
        'message',
    ];

    public function givePointUser()
    {
        return $this->belongsTo(User::class, 'give_user_id', 'id');
    }

    public function receivePointUser()
    {
        return $this->belongsTo(User::class, 'receive_user_id', 'id');
    }
}
