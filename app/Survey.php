<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'pm1',
        'pm25',
        'pm10',
        'location',
        'device_key',
        'temperature',
        'pressure',
        'humidity',
    ];
}
