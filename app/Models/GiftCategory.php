<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCategory extends Model
{
    protected $table = 'gift_categories';

    protected $fillable = [
        'name',
        'path',
        'title1',
        'title2',
        'icon',
        'image_name',
    ];
}
