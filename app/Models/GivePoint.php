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
}
