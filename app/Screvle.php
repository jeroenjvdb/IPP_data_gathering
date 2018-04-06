<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screvle extends Model
{
    protected $table = 'screvle';

    public $fillable= [
        'payload',
        'type',
        'address',
    ];
}
