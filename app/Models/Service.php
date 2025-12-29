<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'price',
        'show_price'
    ];

    protected $casts = [
        'show_price' => 'boolean'
    ];
}