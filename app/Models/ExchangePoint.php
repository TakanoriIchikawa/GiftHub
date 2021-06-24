<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangePoint extends Model
{
    protected $table = 'exchange_points';

    protected $fillable = [
        'user_id',
        'gift_item_id',
        'exchange_point',
    ];
}
