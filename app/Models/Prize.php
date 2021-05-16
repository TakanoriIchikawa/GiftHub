<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $table = 'prizes';

    protected $fillable = [
        'prize_category_id',
        'name',
        'points',
    ];
}
