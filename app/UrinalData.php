<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrinalData extends Model
{
    protected $table = 'urinal_datas';

    public $fillable= [
	'type',
	'nb_flush',
        'congestion',
	'clogged',
	'nb_mkey',
	't_evac',
	'payload',
        'type',
        'address',
    ];
}
