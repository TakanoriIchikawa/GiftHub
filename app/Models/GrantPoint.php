<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrantPoint extends Model
{
    protected $table = 'grant_points';

    protected $fillable = [
        'user_id',
        'grant_point',
        'available_point',
        'expiration_date',
    ];
}
