<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelFeature extends Model
{
    public $timestamps = false;

    protected $casts = [
        'car_feature' => 'array'
    ];
}
