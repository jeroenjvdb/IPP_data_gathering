<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urinal extends Model
{
    protected $table = 'urinals';

    public $fillable= [
	'device',
    ];

    public function data() 
    {
	    return $this->hasMany('App\UrinalData', 'device_id');
    }

    public function uData() 
    {
	    return $this->hasMany('App\UData', 'device_id');
    }

    
}
