<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UData extends Model
{
    protected $table = 'u_datas';

    public $fillable= [
        'type',
        'nb_flush',
        'nb_user',
        'status',
        'user_flush_time',
        'flush_time',
        'key_present_ev',
        'address',
        'payload',
    ];

    public $appends = [
        'congestion',
        'clogged',
    ];

    public $casts = [
        'congestion' => 'boolean',
        'clogged' => 'boolean',
    ];

    public function getCloggedAttribute() {
        return $this->status & 1;
    }

    public function getCongestionAttribute() {
        return $this->status & 2;
    }
}
