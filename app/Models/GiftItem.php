<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftItem extends Model
{
    protected $table = 'gift_items';

    protected $fillable = [
        'gift_category_id',
        'name',
        'point',
        'image',
    ];
}
