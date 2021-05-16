<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrizeCategory extends Model
{
    protected $table = 'prize_categories';

    protected $fillable = [
        'name',
        'path',
        'title1',
        'title2',
        'icon',
        'image_name',
    ];
}
