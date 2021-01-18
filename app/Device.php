<?php

namespace App;

use App\Survey;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $fillable = [
        'key',
        'state',
        'tel'
    ];

    public function surveys()
    {
        return $this->hasMany(Survey::class, 'device_id');
    }
}
	